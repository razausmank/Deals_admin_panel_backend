<x-master title="Edit Store"
    :breadcrumbs="[ 'Stores' => 'store.index', 'Edit Store' => '#'  ]">

    <x-cards.basic-card title="Edit Store">
        {{-- @if($errors->any())
            {!! implode('', $errors->all('<div>:message</div>')) !!}
        @endif --}}
        <x-form.form>
            <x-slot name="form_tag">
                <form action="{{ route('store.update' , $store) }}" method="POST" enctype="multipart/form-data"
                    id="store_update_form">
                    @csrf
                    @method('PATCH')
            </x-slot>

            <x-form.form_group label="Name" error="name">
                <x-form.form_input type="text" name="name" placeholder="Enter Store's name" value="{{ $store->name }}"/>
            </x-form.form_group>

            <x-form.form_group label="Image" error="image">
                <x-form.form_image_input id="image_field" name="image" add_title="Add Store Image"
                    remove_title="Remove Store Image" :image="$store->image"/>
            </x-form.form_group>

            <x-form.form_group label="City" error="city_id">

                <x-form.form_dropdown name="city_id" id="create_store_city_select">

                    <x-slot name="custom_element">
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ $store->city_id == $city->id ? 'selected' : '' }}> {{ $city->name }} </option>
                        @endforeach
                    </x-slot>

                </x-form.form_dropdown>

            </x-form.form_group>

            <x-form.form_group label="Address" error="address">
                <x-form.form_input type="text" name="address" placeholder="Enter Store's Address" value="{{ $store->address }}"/>
            </x-form.form_group>

            <x-form.form_group label="Timing" error="timing">
                <x-form.form_input type="text" name="timing" placeholder="Enter Store's Timing" value="{{ $store->timing }}"/>
            </x-form.form_group>

            <x-form.form_group label="Longitude" error="longitude">
                <x-form.form_input type="number" name="longitude" custom_attributes='step=any' placeholder="Enter Store's Longitude" value="{{ $store->longitude }}"/>
            </x-form.form_group>

            <x-form.form_group label="Latitude" error="latitude">
                <x-form.form_input type="number" name="latitude" custom_attributes='step=any' placeholder="Enter Store's Latitude" value="{{ $store->latitude }}"/>
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

