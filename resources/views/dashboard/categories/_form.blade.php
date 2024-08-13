{{-- this file is not to be composed to controllers, we just create it to use it
so, we put the _ before it's name --}}

<div>

    <x-form.input lable="Category Name" name="name" :value="$category->name" />

    <x-form.textarea lable="Description" name="description" :value="$category->description" />

    <x-form.select lable="Category Parent" name="parent_id" :value="$category->parent_id" :parents="$parents" />

    <x-form.image lable="Image" name="image" :image="$category->image" />

    <div class="form-group">
        <label for="parent">Status</label>
        <div class="form-check">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="active" name="status" value=" active"
                    @class(['custom-control-input', 'is-invalid'=>
                $errors->has('status') ])
                @checked(old('status', $category->status) == 'active' ) >
                <label class="custom-control-label" for="active">Active</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="archived" name="status" value=" archived"
                    @class(['custom-control-input', 'is-invalid'=> $errors->has('status') ])
                @checked(old('status', $category->status) == 'archived' ) >
                <label class="custom-control-label" for="archived">Archived</label>
            </div>
            @error('status')
            <small class="text-danger"> {{ $message }} </small>
            @enderror
        </div>
    </div>

    <div class="form-group btn-lg btn-block" style="display: flex; justify-content: flex-end;">
        <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
    </div>
</div>