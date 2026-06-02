<?php

namespace Modules\Attendance\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attendance\Repositories\ArtGalleryRepositoryInterface;
use Modules\UserActivityLog\Traits\LogActivity;

class ArtGalleryController extends Controller
{
    protected $artGalleryRepository;

    public function __construct(ArtGalleryRepositoryInterface $artGalleryRepository)
    {
        $this->artGalleryRepository = $artGalleryRepository;
        $this->middleware('maintenance_mode');
        $this->middleware('prohibited_demo_mode')->only('store', 'update', 'destroy');
    }

    public function index()
    {
        try {
            $artGalleries = $this->artGalleryRepository->all();

            return view('attendance::art_galleries.index', compact('artGalleries'));
        } catch (\Exception $e) {
            Toastr::error(__('common.error_message'), __('common.error'));
            LogActivity::errorLog($e->getMessage());

            return back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,bmp,webp',
            'description' => 'nullable',
            'status' => 'required|in:0,1',
        ], ['image.mimes' => 'jpg,png,jpeg,bmp,webp images are support to upload']);

        try {
            $this->artGalleryRepository->create($request->except('_token'));
            Toastr::success(__('common.created_successfully'), __('common.success'));
            LogActivity::successLog('Art Gallery Created Successfully.');

            return back();
        } catch (\Exception $e) {
            Toastr::error(__('common.error_message'), __('common.error'));
            LogActivity::errorLog($e->getMessage());

            return back();
        }
    }

    public function edit($id)
    {
        try {
            $artGalleries = $this->artGalleryRepository->all();
            $editData = $this->artGalleryRepository->find($id);

            if (auth()->user()->role->type != 'admin' && (int) $editData->user_id !== (int) auth()->id()) {
                abort(403);
            }

            return view('attendance::art_galleries.index', compact('artGalleries', 'editData'));
        } catch (\Exception $e) {
            Toastr::error(__('common.error_message'), __('common.error'));
            LogActivity::errorLog($e->getMessage());

            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg,bmp,webp',
            'description' => 'nullable',
            'status' => 'required|in:0,1',
        ]);

        try {
            $item = $this->artGalleryRepository->find($id);
            if (auth()->user()->role->type != 'admin' && (int) $item->user_id !== (int) auth()->id()) {
                abort(403);
            }

            $this->artGalleryRepository->update($request->except('_token'), $id);
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            LogActivity::successLog('Art Gallery Updated Successfully.');

            return redirect()->route('booking.art_galleries');
        } catch (\Exception $e) {
            Toastr::error(__('common.error_message'), __('common.error'));
            LogActivity::errorLog($e->getMessage());

            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $item = $this->artGalleryRepository->find($id);
            if (auth()->user()->role->type != 'admin' && (int) $item->user_id !== (int) auth()->id()) {
                abort(403);
            }

            $this->artGalleryRepository->delete($id);
            Toastr::success(__('common.deleted_successfully'), __('common.success'));
            LogActivity::successLog('Art Gallery Deleted Successfully.');

            return back();
        } catch (\Exception $e) {
            Toastr::error(__('common.error_message'), __('common.error'));
            LogActivity::errorLog($e->getMessage());

            return back();
        }
    }
}
