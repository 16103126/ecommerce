{{-- <option>{{__('Select Sub Category')}}</option> --}}
@foreach ($category->subcategories as $subcategory)
    @if ($subcategory->status == 1)
    <option value="{{ $subcategory->id }}" data-href="{{ route('admin.childcategory.load', $subcategory->id) }}" id="childCategory"> {{ $subcategory->name }} </option>
    @endif
@endforeach 