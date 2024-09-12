{{-- this file is not to be composed to controllers, we just create it to use it
so, we put the _ before it's name --}}

<div>

    <div class="form-group">
        <x-form.input label="Product Name" name="name" :value="$product->name" />
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <x-form.select label="Category" name="category_id" :value="$product->category_id" :options="$categories" />
        </div>

        <div class="form-group col-md-6">
            <x-form.radio label="Status" name="status" :status="$product->status"
                :values="['active', 'archived', 'draft']" />
        </div>
    </div>

    <div class="form-group">
        <x-form.textarea label="Description" name="description" :value="$product->description" />
    </div>

    <div class="form-group">
        <x-form.input label="Tags" name="tags" :value="$tags" />
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <x-form.input type="number" label="Price" name="price" :value="$product->price" />
        </div>

        <div class="form-group col-md-6">
            <x-form.input type="number" label="Compare Price" name="compare_price" :value="$product->compare_price" />
        </div>
    </div>

    <div class="form-group">
        <x-form.image label="Image" name="image" :image="$product->image" />
    </div>

    <x-form.submit-button :buttonlabel="$button_label ?? 'Save'" />
</div>