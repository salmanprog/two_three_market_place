<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SuggestColors;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SuggestColorsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['maintenance_mode', 'auth', 'customer']);
    }

    /**
     * Preset palette (hex with #). Custom picks must still match #RRGGBB validation.
     */
    public static function palette(): array
    {
        return [
            '#00124E',
            '#E63946',
            '#457B9D',
            '#2A9D8F',
            '#F4A261',
            '#264653',
            '#E9C46A',
            '#6A4C93',
            '#8338EC',
            '#FF006E',
        ];
    }

    public function index()
    {
        $suggestColors = SuggestColors::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $existingJobNames = $this->existingJobNamesForUser();

        return view(theme('pages.profile.suggest_colors.index'), compact('suggestColors', 'existingJobNames'));
    }

    public function create()
    {
        $palette = self::palette();
        $existingJobNames = $this->existingJobNamesForUser();

        return view(theme('pages.profile.suggest_colors.create'), compact('palette', 'existingJobNames'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'colors' => $request->filled('colors') ? strtoupper(trim($request->input('colors'))) : '',
            'job_name' => $request->filled('job_name') ? trim($request->input('job_name')) : null,
        ]);

        $request->validate([
            'colors' => [
                'required',
                'regex:/^#[0-9A-F]{6}$/',
            ],
            'job_name' => 'required|string|max:191',
        ]);

        SuggestColors::create([
            'user_id' => auth()->id(),
            'colors' => $request->colors,
            'job_name' => $request->job_name,
            'slug' => $this->uniqueSlug($request->colors),
        ]);

        Toastr::success(__('common.created_successfully'), __('common.success'));

        return redirect()->route('frontend.suggest-colors.index');
    }

    public function edit(SuggestColors $suggestColor)
    {
        $this->authorizeRow($suggestColor);
        $palette = self::palette();
        $existingJobNames = $this->existingJobNamesForUser();

        return view(theme('pages.profile.suggest_colors.edit'), compact('suggestColor', 'palette', 'existingJobNames'));
    }

    public function update(Request $request, SuggestColors $suggestColor)
    {
        $this->authorizeRow($suggestColor);

        $request->merge([
            'colors' => $request->filled('colors') ? strtoupper(trim($request->input('colors'))) : '',
            'job_name' => $request->filled('job_name') ? trim($request->input('job_name')) : null,
        ]);

        $request->validate([
            'colors' => [
                'required',
                'regex:/^#[0-9A-F]{6}$/',
            ],
            'job_name' => 'required|string|max:191',
        ]);

        $suggestColor->colors = $request->colors;
        $suggestColor->job_name = $request->job_name;
        if ($suggestColor->isDirty('colors')) {
            $suggestColor->slug = $this->uniqueSlug($request->colors);
        }
        $suggestColor->save();

        Toastr::success(__('common.updated_successfully'), __('common.success'));

        return redirect()->route('frontend.suggest-colors.index');
    }

    public function destroy(SuggestColors $suggestColor)
    {
        $this->authorizeRow($suggestColor);
        $suggestColor->delete();

        Toastr::success(__('common.deleted_successfully'), __('common.success'));

        return redirect()->route('frontend.suggest-colors.index');
    }

    protected function authorizeRow(SuggestColors $suggestColor): void
    {
        abort_unless((int) $suggestColor->user_id === (int) auth()->id(), 404);
    }

    protected function uniqueSlug(string $hex): string
    {
        $base = Str::slug('color-' . ltrim($hex, '#'));
        do {
            $slug = $base . '-' . Str::lower(Str::random(8));
        } while (SuggestColors::where('slug', $slug)->exists());

        return $slug;
    }

    protected function existingJobNamesForUser()
    {
        return SuggestColors::query()
            ->where('user_id', auth()->id())
            ->whereNotNull('job_name')
            ->where('job_name', '!=', '')
            ->distinct()
            ->orderBy('job_name')
            ->pluck('job_name');
    }
}
