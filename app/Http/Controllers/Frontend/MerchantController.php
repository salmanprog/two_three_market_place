<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Modules\FrontendCMS\Services\MerchantContentService;
use Modules\MultiVendor\Repositories\CommisionRepository;
use \Modules\FrontendCMS\Services\BenefitService;
use \Modules\FrontendCMS\Services\WorkingProcessService;
use \Modules\FrontendCMS\Services\FaqService;
use \Modules\FrontendCMS\Services\PricingService;
use \Modules\FrontendCMS\Services\QueryService;
use Exception;
use Modules\UserActivityLog\Traits\LogActivity;
use App\Models\User;

class MerchantController extends Controller
{
    protected $merchantContentService;
    protected $benefitService;
    protected $faqService;
    protected $workingProcessService;
    protected $pricingService;
    protected $queryService;

    public function __construct(MerchantContentService $merchantContentService, BenefitService $benefitService,
     WorkingProcessService $workingProcessService, FaqService $faqService, PricingService $pricingService, QueryService $queryService)
    {
        $this->middleware('maintenance_mode');
        
        $this->merchantContentService = $merchantContentService;
        $this->benefitService = $benefitService;
        $this->faqService = $faqService;
        $this->workingProcessService = $workingProcessService;
        $this->pricingService = $pricingService;
        $this->queryService = $queryService;
        
    }
    
    public function index(){
        if(isModuleActive('MultiVendor')){
            $data['benefitList'] = $this->benefitService->getAllActive();
            $data['faqList'] = $this->faqService->getAllActive();
            $data['content'] = $this->merchantContentService->getAll();
            $commisionRepo = new CommisionRepository();
            $data['commissions'] = $commisionRepo->getAll();
            $data['pricingList'] = $this->pricingService->getAllActive();
            $data['workProcessList'] = $this->workingProcessService->getAllActive();
            $data['QueryList'] = $this->queryService->getAllActive();
            return view(theme('pages.marchant'),$data);
        }
        abort(404);
    }
    
    public function allMerchants(){
        // Get all active sellers
        $data['sellers'] = User::where('role_id', 5)
                            ->where('is_active', 1)
                            ->with(['SellerAccount', 'SellerBusinessInformation'])
                            ->paginate(12);
        
        return view(theme('pages.merchants'), $data);
    }
}
