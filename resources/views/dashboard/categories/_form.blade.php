{{-- this file is not to be composed to controllers, we just create it to use it
so, we put the _ before it's name --}}

<div>

    <x-form.input lable="Category Name" name="name" :value="$category->name" />

    <x-form.textarea lable="Description" name="description" :value="$category->description" />

    <x-form.select lable="Category Parent" name="parent_id" :value="$category->parent_id" :parents="$parents" />

    <x-form.image lable="Image" name="image" :image="$category->image" />

    <x-form.status lable="Status" name="status" :status="$category->status" :values="['active', 'archived']" />

    <div class="form-group btn-lg btn-block" style="display: flex; justify-content: flex-end;">
        <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
    </div>
</div>