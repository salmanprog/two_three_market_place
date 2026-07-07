@php
    /** @var \Modules\Product\Entities\Product $product */
    $artField = fn (string $field) => old($field, $product->{$field} ?? '');
    $artSelected = fn (string $field, string $value) => $artField($field) === $value ? 'selected' : '';
    $priceSliderValue = $priceSliderValue ?? old('price', 5000);
    $paletteColor = $paletteColor ?? old('palette_color', $product->palette_color ?? '#cccccc');
@endphp

<div class="col-lg-3">
    <div class="primary_input mb-25">
        <label class="primary_input_label">Art Services</label>
        <select class="primary_select mb-25" name="art_services" id="art_services">
            <option value="">Select Art Services</option>
            <option value="Commissions" {{ $artSelected('art_services', 'Commissions') }}>Commissions</option>
            <option value="Murals" {{ $artSelected('art_services', 'Murals') }}>Murals</option>
            <option value="Live Art" {{ $artSelected('art_services', 'Live Art') }}>Live Art</option>
            <option value="Art Shows" {{ $artSelected('art_services', 'Art Shows') }}>Art Shows</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="primary_input mb-25">
        <label class="primary_input_label">Category</label>
        <select class="primary_select mb-25" name="category" id="category">
            <option value="">Select Category</option>
            <option value="All" {{ $artSelected('category', 'All') }}>All</option>
            <option value="Paintings" {{ $artSelected('category', 'Paintings') }}>Paintings</option>
            <option value="Drawing" {{ $artSelected('category', 'Drawing') }}>Drawing</option>
            <option value="Mixed Media" {{ $artSelected('category', 'Mixed Media') }}>Mixed Media</option>
            <option value="Sculpture" {{ $artSelected('category', 'Sculpture') }}>Sculpture</option>
            <option value="Other" {{ $artSelected('category', 'Other') }}>Other</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="primary_input mb-25">
        <label class="primary_input_label">Style</label>
        <select class="primary_select mb-25" name="style" id="style">
            <option value="">Select Style</option>
            <option value="Abstract Art" {{ $artSelected('style', 'Abstract Art') }}>Abstract Art</option>
            <option value="Art Deco" {{ $artSelected('style', 'Art Deco') }}>Art Deco</option>
            <option value="Art Nouveau" {{ $artSelected('style', 'Art Nouveau') }}>Art Nouveau</option>
            <option value="Baroque" {{ $artSelected('style', 'Baroque') }}>Baroque</option>
            <option value="Bauhaus" {{ $artSelected('style', 'Bauhaus') }}>Bauhaus</option>
            <option value="Classicism" {{ $artSelected('style', 'Classicism') }}>Classicism</option>
            <option value="Contemporary Art" {{ $artSelected('style', 'Contemporary Art') }}>Contemporary Art</option>
            <option value="Cubism" {{ $artSelected('style', 'Cubism') }}>Cubism</option>
            <option value="Dadaism" {{ $artSelected('style', 'Dadaism') }}>Dadaism</option>
            <option value="Expressionism" {{ $artSelected('style', 'Expressionism') }}>Expressionism</option>
            <option value="Fauvism" {{ $artSelected('style', 'Fauvism') }}>Fauvism</option>
            <option value="Figurative" {{ $artSelected('style', 'Figurative') }}>Figurative</option>
            <option value="Harlem Renaissance" {{ $artSelected('style', 'Harlem Renaissance') }}>Harlem Renaissance</option>
            <option value="Impressionism" {{ $artSelected('style', 'Impressionism') }}>Impressionism</option>
            <option value="Minimalism" {{ $artSelected('style', 'Minimalism') }}>Minimalism</option>
            <option value="Neoclassicism" {{ $artSelected('style', 'Neoclassicism') }}>Neoclassicism</option>
            <option value="Neo-Impressionism" {{ $artSelected('style', 'Neo-Impressionism') }}>Neo-Impressionism</option>
            <option value="Pop Art" {{ $artSelected('style', 'Pop Art') }}>Pop Art</option>
            <option value="Post-Impressionism" {{ $artSelected('style', 'Post-Impressionism') }}>Post-Impressionism</option>
            <option value="Realism" {{ $artSelected('style', 'Realism') }}>Realism</option>
            <option value="Surrealism" {{ $artSelected('style', 'Surrealism') }}>Surrealism</option>
            <option value="Other" {{ $artSelected('style', 'Other') }}>Other</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="primary_input mb-25">
        <label class="primary_input_label">Subject</label>
        <select class="primary_select mb-25" name="subject" id="subject">
            <option value="">Select Subject</option>
            <option value="Abstract" {{ $artSelected('subject', 'Abstract') }}>Abstract</option>
            <option value="Landscape" {{ $artSelected('subject', 'Landscape') }}>Landscape</option>
            <option value="Pop Culture" {{ $artSelected('subject', 'Pop Culture') }}>Pop Culture</option>
            <option value="People" {{ $artSelected('subject', 'People') }}>People</option>
            <option value="Animal" {{ $artSelected('subject', 'Animal') }}>Animal</option>
            <option value="Floral" {{ $artSelected('subject', 'Floral') }}>Floral</option>
            <option value="Nature" {{ $artSelected('subject', 'Nature') }}>Nature</option>
            <option value="Seascape" {{ $artSelected('subject', 'Seascape') }}>Seascape</option>
            <option value="Dogs" {{ $artSelected('subject', 'Dogs') }}>Dogs</option>
            <option value="Cats" {{ $artSelected('subject', 'Cats') }}>Cats</option>
            <option value="Religious" {{ $artSelected('subject', 'Religious') }}>Religious</option>
            <option value="Love" {{ $artSelected('subject', 'Love') }}>Love</option>
            <option value="Nude" {{ $artSelected('subject', 'Nude') }}>Nude</option>
            <option value="Geometric" {{ $artSelected('subject', 'Geometric') }}>Geometric</option>
            <option value="Music" {{ $artSelected('subject', 'Music') }}>Music</option>
            <option value="Food/Drinks" {{ $artSelected('subject', 'Food/Drinks') }}>Food/Drinks</option>
            <option value="Medical" {{ $artSelected('subject', 'Medical') }}>Medical</option>
            <option value="Sports" {{ $artSelected('subject', 'Sports') }}>Sports</option>
            <option value="Men" {{ $artSelected('subject', 'Men') }}>Men</option>
            <option value="Women" {{ $artSelected('subject', 'Women') }}>Women</option>
            <option value="Buildings" {{ $artSelected('subject', 'Buildings') }}>Buildings</option>
            <option value="Cartoon" {{ $artSelected('subject', 'Cartoon') }}>Cartoon</option>
            <option value="Other" {{ $artSelected('subject', 'Other') }}>Other</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="primary_input mb-25">
        <label class="primary_input_label">Medium</label>
        <select class="primary_select mb-25" name="medium" id="medium">
            <option value="">Select Medium</option>
            <option value="Acrylic" {{ $artSelected('medium', 'Acrylic') }}>Acrylic</option>
            <option value="Oil" {{ $artSelected('medium', 'Oil') }}>Oil</option>
            <option value="Watercolor" {{ $artSelected('medium', 'Watercolor') }}>Watercolor</option>
            <option value="Ink" {{ $artSelected('medium', 'Ink') }}>Ink</option>
            <option value="Ceramic" {{ $artSelected('medium', 'Ceramic') }}>Ceramic</option>
            <option value="Other" {{ $artSelected('medium', 'Other') }}>Other</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="primary_input mb-25">
        <label class="primary_input_label">Material</label>
        <select class="primary_select mb-25" name="material" id="material">
            <option value="">Select Material</option>
            <option value="Canvas" {{ $artSelected('material', 'Canvas') }}>Canvas</option>
            <option value="Paper" {{ $artSelected('material', 'Paper') }}>Paper</option>
            <option value="Wood" {{ $artSelected('material', 'Wood') }}>Wood</option>
            <option value="Metal" {{ $artSelected('material', 'Metal') }}>Metal</option>
            <option value="Other" {{ $artSelected('material', 'Other') }}>Other</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="primary_input mb-25">
        <label class="primary_input_label">Price</label>
        <input
            type="range"
            class="primary_range"
            id="price"
            name="price"
            min="0"
            max="10000"
            step="50"
            value="{{ $priceSliderValue }}"
        >
        <div class="mt-10">
            Up to: <strong>$<span id="price_value">{{ $priceSliderValue }}</span></strong>
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="primary_input mb-25">
        <label class="primary_input_label">Color Palette</label>
        <input
            type="color"
            class="form-control"
            name="palette_color"
            id="palette_color"
            value="{{ $paletteColor }}"
        >
        <small class="text-muted">
            Select one color from the palette
        </small>
    </div>
</div>

<div class="col-lg-3">
    <div class="primary_input mb-25">
        <label class="primary_input_label">Size</label>
        <select class="primary_select mb-25" name="size" id="size">
            <option value="">Select Size</option>
            <option value="Small" {{ $artSelected('size', 'Small') }}>Small (&lt; 20in)</option>
            <option value="Medium" {{ $artSelected('size', 'Medium') }}>Med (20–38in)</option>
            <option value="Large" {{ $artSelected('size', 'Large') }}>Large (38–60in)</option>
            <option value="X Large" {{ $artSelected('size', 'X Large') }}>X Large (&gt; 60in)</option>
        </select>
    </div>
</div>
