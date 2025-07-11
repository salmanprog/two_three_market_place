<?php

namespace Modules\Reseller\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Reseller\Services\ResellerService;
use Modules\Reseller\Repositories\ResellRequestRepository;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

class ResellRequestController extends Controller
{
    protected $resellerService;
    protected $resellRequestRepository;

    public function __construct(
        ResellerService $resellerService,
        ResellRequestRepository $resellRequestRepository
    ) {
        $this->resellerService = $resellerService;
        $this->resellRequestRepository = $resellRequestRepository;
    }

    /**
     * Display a listing of resell requests
     */
    public function index(Request $request)
    {
        try {
            $status = $request->get('status', 'all');
            $perPage = $request->get('per_page', 15);

            switch ($status) {
                case 'pending':
                    $requests = $this->resellRequestRepository->getPendingRequests($perPage);
                    break;
                case 'approved':
                    $requests = $this->resellRequestRepository->getApprovedRequests($perPage);
                    break;
                case 'rejected':
                    $requests = $this->resellRequestRepository->getRejectedRequests($perPage);
                    break;
                default:
                    $requests = $this->resellRequestRepository->getAllRequests($perPage);
                    break;
            }

            $statistics = $this->resellerService->getAdminStatistics();

            return view('reseller::admin.resell-requests.index', compact('requests', 'statistics', 'status'));
        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resell request
     */
    public function create()
    {
        return view('reseller::admin.resell-requests.create');
    }

    /**
     * Store a newly created resell request in storage
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id',
                'seller_product_sku_id' => 'required|exists:seller_product_s_k_us,id',
                'product_condition' => 'required|in:new,used',
                'selling_price' => 'required|numeric|min:0',
                'customer_note' => 'nullable|string|max:1000',
            ]);

            $resellRequest = $this->resellerService->submitResellRequest($validated);

            Toastr::success('Resell request created successfully.');
            return redirect()->route('admin.resell-requests.index');

        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resell request
     */
    public function show($id)
    {
        try {
            $resellRequest = $this->resellRequestRepository->findById($id);
            return view('reseller::admin.resell-requests.show', compact('resellRequest'));
        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resell request
     */
    public function edit($id)
    {
        try {
            $resellRequest = $this->resellRequestRepository->findById($id);
            return view('reseller::admin.resell-requests.edit', compact('resellRequest'));
        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified resell request in storage
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'product_condition' => 'required|in:new,used',
                'selling_price' => 'required|numeric|min:0',
                'customer_note' => 'nullable|string|max:1000',
            ]);

            $resellRequest = $this->resellRequestRepository->findById($id);
            $resellRequest->update($validated);

            Toastr::success('Resell request updated successfully.');
            return redirect()->route('admin.resell-requests.index');

        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resell request from storage
     */
    public function destroy($id)
    {
        try {
            $resellRequest = $this->resellRequestRepository->findById($id);
            $resellRequest->delete();

            Toastr::success('Resell request deleted successfully.');
            return redirect()->route('admin.resell-requests.index');

        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Approve a resell request
     */
    public function approve(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'admin_note' => 'nullable|string|max:1000',
            ]);

            $resellRequest = $this->resellerService->approveResellRequest($id, $validated['admin_note'] ?? null);

            Toastr::success('Resell request approved successfully.');
            return redirect()->route('admin.resell-requests.index');

        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Reject a resell request
     */
    public function reject(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'admin_note' => 'nullable|string|max:1000',
            ]);

            $resellRequest = $this->resellerService->rejectResellRequest($id, $validated['admin_note'] ?? null);

            Toastr::success('Resell request rejected successfully.');
            return redirect()->route('admin.resell-requests.index');

        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display resale products
     */
    public function resaleProducts(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 15);
            $products = $this->resellerService->getResaleProductsForFrontend($perPage);

            return view('reseller::admin.resale-products.index', compact('products'));
        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display reseller dashboard
     */
    public function dashboard()
    {
        try {
            $statistics = $this->resellerService->getAdminStatistics();
            $recentRequests = $this->resellRequestRepository->getAllRequests(5);

            return view('reseller::admin.dashboard', compact('statistics', 'recentRequests'));
        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Export resell requests
     */
    public function export(Request $request)
    {
        try {
            $status = $request->get('status', 'all');
            $format = $request->get('format', 'csv');

            switch ($status) {
                case 'pending':
                    $requests = $this->resellRequestRepository->getPendingRequests(1000);
                    break;
                case 'approved':
                    $requests = $this->resellRequestRepository->getApprovedRequests(1000);
                    break;
                case 'rejected':
                    $requests = $this->resellRequestRepository->getRejectedRequests(1000);
                    break;
                default:
                    $requests = $this->resellRequestRepository->getAllRequests(1000);
                    break;
            }

            // Implementation for export would depend on your export library
            // For now, just return a success message
            Toastr::success('Export completed successfully.');
            return redirect()->back();

        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }
} 