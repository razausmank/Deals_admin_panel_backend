<x-master title="New Store"
    :breadcrumbs="[ 'Stores' => 'store.index', 'New Store' => 'store.create'  ]">

    <x-cards.basic-card title="New Store">
        {{-- @if($errors->any())
            {!! implode('', $errors->all('<div>:message</div>')) !!}
        @endif --}}
        <x-form.form>
            <x-slot name="form_tag">
                <form action="{{ route('store.store') }}" method="POST" enctype="multipart/form-data"
                    id="store_create_form">
                    @csrf
                    @method('POST')
            </x-slot>

            <x-form.form_group label="Name" error="name">
                <x-form.form_input type="text" name="name" placeholder="Enter Store's name" value="{{ old('name') }}"/>
            </x-form.form_group>

            <x-form.form_group label="Image" error="image">
                <x-form.form_image_input id="image_field" name="image" add_title="Add Store Image"
                    remove_title="Remove Store Image" />
            </x-form.form_group>

            <x-form.form_group label="City" error="city_id">

                <x-form.form_dropdown name="city_id" id="create_store_city_select">

                    <x-slot name="custom_element">
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}"> {{ $city->name }} </option>
                        @endforeach
                    </x-slot>

                </x-form.form_dropdown>

            </x-form.form_group>

            <x-form.form_group label="Address" error="address">
                <x-form.form_input type="text" name="address" placeholder="Enter Store's Address" value="{{ old('address') }}"/>
            </x-form.form_group>

            <x-form.form_group label="Timing" error="timing">
                <x-form.form_input type="text" name="timing" placeholder="Enter Store's Timing" value="{{ old('timing') }}"/>
            </x-form.form_group>

            <x-form.form_group label="Longitude" error="longitude">
                <x-form.form_input type="number" name="longitude" custom_attributes='step=any' placeholder="Enter Store's Longitude" value="{{ old('longitude') }}"/>
            </x-form.form_group>

            <x-form.form_group label="Latitude" error="latitude">
                <x-form.form_input type="number" name="latitude" custom_attributes='step=any' placeholder="Enter Store's Latitude" value="{{ old('latitude') }}"/>
            </x-form.form_group>


        </x-form.form>


    </x-cards.basic-card>
    <x-slot name="scripts">
        <script>
            $( document ).ready(function() {
                var image_field = new KTImageInput('image_field');
            });

        </script>
    </x-slot>

</x-master>

