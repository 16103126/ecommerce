{{-- <option>{{__('Select Child Category')}}</option> --}}
@foreach ($subcategory->childcategories as $childcategory)
    @if ($childcategory->status == 1)
    <option value="{{ $childcategory->id }}"> {{ $childcategory->name }} </option>
    @endif
@endforeach 