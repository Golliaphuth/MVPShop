<?php

namespace App\Http\Controllers\Admin;

use App\Console\Commands\Import\SANDI\ImportCommand;
use App\Http\Controllers\Controller;
use App\Models\ImportConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ImportController extends Controller
{
    public function index(Request $request)
    {
        $options = ImportConfig::where('domain', 'SANDI')->get()->pluck('value', 'option')->toArray();
        return view('admin.import.index', [
            'options' => $options,
            'state' => Redis::get('import:state')
        ]);
    }

    public function optionsStore(Request $request): \Illuminate\Http\JsonResponse
    {
        $domain = "SANDI";
        $availableOptions = ImportConfig::$options;
        foreach ($request->all() as $key => $val) {
            if (in_array($key, $availableOptions)) {
                ImportConfig::updateOrCreate(['domain' => $domain, 'option' => $key], ['value' => $val]);
            }
        }

        return response()->json($request->all(), 200);
    }

    public function start(): \Illuminate\Http\JsonResponse
    {

        if(Redis::get('import:state')) {
            return response()->json([
                'message' => 'Import in progress!'
            ], 200);
        }

        Bus::dispatch(new ImportCommand());
        return response()->json('ok', 200);
    }
}
