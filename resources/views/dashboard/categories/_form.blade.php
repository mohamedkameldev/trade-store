{{-- this file is not to be composed to controllers, we just create it to use it
so, we put the _ before it's name --}}

<div>

    <x-form.input label="Category Name" name="name" :value="$category->name" />

    <x-form.textarea label="Description" name="description" :value="$category->description" />

    <x-form.select label="Category Parent" name="parent_id" default="Primary Category" :value="$category->parent_id"
        :options="$parents" />

    <x-form.image label="Image" name="image" :image="$category->image" />

    <x-form.radio label="Status" name="status" :status="$category->status" :values="['active', 'archived']" />

    <x-form.submit-button :buttonlabel="$button_label ?? 'Save'" />
</div>