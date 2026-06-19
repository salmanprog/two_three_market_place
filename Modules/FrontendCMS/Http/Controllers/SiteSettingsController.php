<?php

namespace Modules\FrontendCMS\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\FrontendCMS\Services\SiteContactService;
use Modules\UserActivityLog\Traits\LogActivity;

class SiteSettingsController extends Controller
{
    protected SiteContactService $siteContactService;

    public function __construct(SiteContactService $siteContactService)
    {
        $this->middleware(['maintenance_mode']);
        $this->middleware('prohibited_demo_mode')->only('contactUpdate');
        $this->siteContactService = $siteContactService;
    }

    public function index()
    {
        $this->ensureAdminAccess();

        return redirect()->route('admin.site-settings.contact');
    }

    public function contact()
    {
        $this->ensureAdminAccess();

        try {
            $contactSettings = $this->siteContactService->get();

            return view('frontendcms::site_settings.contact', compact('contactSettings'));
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));

            return back();
        }
    }

    public function contactUpdate(Request $request)
    {
        $this->ensureAdminAccess();

        $request->validate([
            'title' => 'required|string|max:255',
            'profiles' => 'required|array|min:1',
            'profiles.*.name' => 'required|string|max:255',
            'profiles.*.phone' => 'required|string|max:50',
            'profiles.*.email' => 'required|email|max:255',
            'profiles.*.existing_image' => 'nullable|string',
            'profiles.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            $contactSettings = $this->siteContactService->update($request->only('title', 'profiles'), $request);
            LogActivity::successLog('Site contact settings updated.');

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => __('common.updated_successfully'),
                    'title' => $contactSettings['title'],
                    'profiles' => $this->siteContactService->formatProfilesForDisplay($contactSettings['profiles']),
                ]);
            }

            Toastr::success(__('common.updated_successfully'), __('common.success'));

            return back();
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 500);
            }

            Toastr::error(__('common.error_message'), __('common.error'));

            return back();
        }
    }

    protected function ensureAdminAccess(): void
    {
        if (!in_array(auth()->user()->role->type, ['admin', 'superadmin'], true)) {
            abort(403);
        }
    }
}
