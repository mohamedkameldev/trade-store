{{-- this file is not to be composed to controllers, we just create it to use it
so, we put the _ before it's name --}}

<div>
    <div class="form-group">
        <x-form.input lable="Category Name" name="name" :value="$category->name" />
    </div>


    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description"
            @class(['form-control', 'is-invalid'=> $errors->has('description') ]) id="description" rows="2">{{ old('description', $category->description )}}</textarea>
        @error('description')
        <div class="invalid-feedback"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="parent">Category Parent</label>
        <select name="parent_id" @class(['form-control', 'is-invalid'=> $errors->has('parent_id') ])>
            <option {{ old('parent_id', $category->parent_id ) ?? 'selected' }} value="">Primary Category</option>
            @foreach ($parents as $parent)
            <option value="{{$parent->id}}" @selected(old('parent_id', $category->parent_id ) == $parent->id)>
                {{$parent->name}} </option>
            @endforeach
        </select>
        @error('parent_id')
        <div class="invalid-feedback"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <div class="d-flex image-label-container">
            <label for="image">Image</label>
            @if ($category->image)
            <img class="ml-4 mb-2" src="{{asset('storage/' . $category->image)}}" alt="image" width="100" height="auto">
            @endif
        </div>
        <div class="custom-file">
            <input type="file" @class(['custom-file-input', 'is-invalid'=> $errors->has('image') ])
            name="image" id="image" accept="image/*">
            <label class="custom-file-label" for="image"> {{old('image', $category->image) ?? 'Choose file' }} </label>
            @error('image')
            <div class="invalid-feedback"> {{ $message }} </div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="parent">Status</label>
        <div class="form-check">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="active" name="status" value=" active"
                    @class(['custom-control-input', 'is-invalid'=> $errors->has('status') ])
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