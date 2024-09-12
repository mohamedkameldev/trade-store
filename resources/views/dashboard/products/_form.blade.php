{{-- this file is not to be composed to controllers, we just create it to use it
so, we put the _ before it's name --}}

<div>

    {{-- Name --}}
    <div class="form-group">
        <x-form.input label="Product Name" name="name" :value="$product->name" />
    </div>

    {{-- Category and Status --}}
    <div class="form-row">
        <div class="form-group col-md-6">
            <x-form.select label="Category" name="category_id" :value="$product->category_id" :options="$categories" />
        </div>

        <div class="form-group col-md-6">
            <x-form.radio label="Status" name="status" :status="$product->status"
                :values="['active', 'archived', 'draft']" />
        </div>
    </div>

    {{-- Description --}}
    <div class="form-group">
        <x-form.textarea label="Description" name="description" :value="$product->description" />
    </div>

    {{-- Tags --}}
    <div class="form-group">
        <x-form.input label="Tags" name="tags" :value="$tags ?? ''" />
    </div>

    {{-- Price and Compare Price --}}
    <div class="form-row">
        <div class="form-group col-md-6">
            <x-form.input type="number" label="Price" name="price" :value="$product->price" />
        </div>

        <div class="form-group col-md-6">
            <x-form.input type="number" label="Compare Price" name="compare_price" :value="$product->compare_price" />
        </div>
    </div>

    {{-- Image --}}
    <div class="form-group">
        <x-form.image label="Image" name="image" :image="$product->image" />
    </div>

    <x-form.submit-button :buttonlabel="$button_label ?? 'Save'" />
</div>

@push('styles')
{{-- using CDN
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" /> --}}

<link rel="stylesheet" href="{{asset('dist/css/tagify.css')}}">
@endpush


@push('scripts')
{{-- using CDN
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script> --}}

<script src="{{ asset('dist/js/tagify.polyfills.min.js') }}"></script>
<script src="{{ asset('dist/js/tagify.js') }}"></script>
<script>
    var inputElem = document.querySelector('[name=tags]'); // the 'input' element which will be transformed into a Tagify component
    var tagify = new Tagify(inputElem);

    // var input = document.querySelector('input[name=tags]');
    // new Tagify(input)
</script>
@endpush