<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Psr\Log\LoggerInterface;
//use App\Services\PageContentService;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected LoggerInterface $logger;
//    protected PageContentService $pageContentService;

    public function __construct()
    {
//        $this->pageContentService = resolve(PageContentService::class);
        $this->logger = resolve(LoggerInterface::class);
    }

    protected function blockRequest() {
        if (is_xhr_request()) {
            response()->json(['error' => 'Forbidden (403)'], 200);
            exit();
        } else {
            abort('403');
        }
    }

    protected function notFound() {
        if (is_xhr_request()) {
            response()->json(['error' => 'Not Found (404)'], 200);
            exit();
        } else {
            abort('404');
        }
    }
}
