<x-master title="Edit Deal"
    :breadcrumbs="[ 'Deals' => 'deal.index', 'Edit Deal' => '#'  ]">

    <x-cards.basic-card title="Edit Deal">
        {{-- @if($errors->any())
            {!! implode('', $errors->all('<div>:message</div>')) !!}
        @endif --}}
        <x-form.form>

            <x-slot name="form_tag">
                <form action="{{ route('deal.update', $deal) }}" method="POST" enctype="multipart/form-data"
                    id="deal_create_form">
                    @csrf
                    @method('PATCH')
            </x-slot>

            <x-form.form_group label="Name" error="title">
                <x-form.form_input type="text" name="title" placeholder="Enter Deal's title" value="{{ $deal->title }}"/>
            </x-form.form_group>

            <x-form.form_group label="Name" error="description">
                <x-form.form_input type="text" name="description" placeholder="Enter Deal's Description" value="{{ $deal->description }}"/>
            </x-form.form_group>

            <x-form.form_group label="Image" error="image">
                <x-form.form_image_input id="image_field" name="image" add_title="Add Store Image"
                    remove_title="Remove Store Image"  :image="$deal->image"/>
            </x-form.form_group>

            <x-form.form_group label="PDF" error="pdf">
                <x-form.form_input type="file" name="pdf" placeholder="PDF"  value="{{ asset(Storage::url($deal->pdf)) }}"/>
            </x-form.form_group>

            <x-form.form_group label="Store" error="store_id">

                <x-form.form_dropdown name="store_id" id="create_deal_store_select">

                    <x-slot name="custom_element">
                        @foreach ($stores as $store)
                            <option value="{{ $store->id }}" {{ $deal->store->id == $store->id ? 'selected' : '' }}> {{ $store->name }} </option>
                        @endforeach
                    </x-slot>

                </x-form.form_dropdown>

            </x-form.form_group>

            <x-form.form_group label="Resource Link" error="resource_link">
                <x-form.form_input type="text" name="resource_link" placeholder="Enter Deal's Resource Link" value="{{ $deal->resource_link }}"/>
            </x-form.form_group>

            <x-form.form_group label="Promotion Start Date" error="promotion_start_date">
                <x-form.form_input type="date" name="promotion_start_date" placeholder="Enter Deals's Promotion Start Date" value="{{ $deal->promotion_start_date }}"/>
            </x-form.form_group>

            <x-form.form_group label="Promotion End Date" error="promotion_end_date">
                <x-form.form_input type="date" name="promotion_end_date" placeholder="Enter Deals's Promotion End Date" value="{{ $deal->promotion_end_date }}"/>
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

