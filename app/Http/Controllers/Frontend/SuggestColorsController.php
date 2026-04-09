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

        return view(theme('pages.profile.suggest_colors.index'), compact('suggestColors'));
    }

    public function create()
    {
        $palette = self::palette();

        return view(theme('pages.profile.suggest_colors.create'), compact('palette'));
    }

    public function store(Request $request)
    {
        $palette = self::palette();
        $request->merge([
            'colors' => $request->filled('colors') ? strtoupper(trim($request->input('colors'))) : '',
        ]);

        $request->validate([
            'colors' => [
                'required',
                'regex:/^#[0-9A-F]{6}$/',
            ],
        ]);

        if (! in_array($request->colors, $palette, true)) {
            Toastr::error(__('common.error_message'), __('common.error'));

            return redirect()->back()->withInput();
        }

        SuggestColors::create([
            'user_id' => auth()->id(),
            'colors' => $request->colors,
            'slug' => $this->uniqueSlug($request->colors),
        ]);

        Toastr::success(__('common.created_successfully'), __('common.success'));

        return redirect()->route('frontend.suggest-colors.index');
    }

    public function edit(SuggestColors $suggestColor)
    {
        $this->authorizeRow($suggestColor);
        $palette = self::palette();

        return view(theme('pages.profile.suggest_colors.edit'), compact('suggestColor', 'palette'));
    }

    public function update(Request $request, SuggestColors $suggestColor)
    {
        $this->authorizeRow($suggestColor);

        $palette = self::palette();
        $request->merge([
            'colors' => $request->filled('colors') ? strtoupper(trim($request->input('colors'))) : '',
        ]);

        $request->validate([
            'colors' => [
                'required',
                'regex:/^#[0-9A-F]{6}$/',
            ],
        ]);

        if (! in_array($request->colors, $palette, true)) {
            Toastr::error(__('common.error_message'), __('common.error'));

            return redirect()->back()->withInput();
        }

        $suggestColor->colors = $request->colors;
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
}
