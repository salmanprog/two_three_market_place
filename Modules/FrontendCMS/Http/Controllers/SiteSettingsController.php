<?php

namespace Modules\FrontendCMS\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\FrontendCMS\Services\SiteContactService;
use Modules\FrontendCMS\Services\SiteHomePageService;
use Modules\UserActivityLog\Traits\LogActivity;

class SiteSettingsController extends Controller
{
    protected SiteContactService $siteContactService;

    protected SiteHomePageService $siteHomePageService;

    public function __construct(SiteContactService $siteContactService, SiteHomePageService $siteHomePageService)
    {
        $this->middleware(['maintenance_mode']);
        $this->middleware('prohibited_demo_mode')->only(['contactUpdate', 'homeUpdate']);
        $this->siteContactService = $siteContactService;
        $this->siteHomePageService = $siteHomePageService;
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
            'profiles.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
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

    public function home()
    {
        $this->ensureAdminAccess();

        try {
            $homeSettings = $this->siteHomePageService->getForAdmin();

            return view('frontendcms::site_settings.home', compact('homeSettings'));
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));

            return back();
        }
    }

    public function homeUpdate(Request $request)
    {
        $this->ensureAdminAccess();

        $request->validate([
            'marketplace.heading' => 'required|string|max:255',
            'marketplace.intro' => 'required|string|max:1000',
            'marketplace.cards' => 'required|array|size:3',
            'marketplace.cards.*.title' => 'required|string|max:255',
            'marketplace.cards.*.description' => 'required|string|max:255',
            'marketplace.cards.*.button_text' => 'required|string|max:255',
            'marketplace.cards.*.button_url' => 'required|string|max:500',
            'marketplace.cards.*.existing_image' => 'nullable|string',
            'marketplace.cards.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'location_artists.heading' => 'required|string|max:255',
            'location_artists.items' => 'required|array|size:3',
            'location_artists.items.*.title' => 'required|string|max:255',
            'location_artists.items.*.description' => 'required|string|max:2000',
            'location_artists.items.*.button_text' => 'nullable|string|max:255',
            'location_artists.items.*.button_url' => 'nullable|string|max:500',
            'location_artists.items.*.existing_number_image' => 'nullable|string',
            'location_artists.items.*.existing_icon_image' => 'nullable|string',
            'location_artists.items.*.number_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'location_artists.items.*.icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        try {
            $homeSettings = $this->siteHomePageService->update(
                $request->only('marketplace', 'location_artists'),
                $request
            );
            LogActivity::successLog('Site home page settings updated.');

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => __('common.updated_successfully'),
                    'marketplace' => $homeSettings['marketplace'],
                    'location_artists' => $homeSettings['location_artists'],
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
