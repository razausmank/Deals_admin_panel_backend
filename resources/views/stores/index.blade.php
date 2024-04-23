<x-master title="Stores" :breadcrumbs="[ 'Stores' => 'store.index']">

    <x-flash />

    <x-datatable.basic title="List of Stores" button_link="store.create"
        button_text="New Store" table_id="stores_list_datatable">
        <x-slot name="header">
            <th>Name</th>
            <th>City</th>
            <th>Deals</th>
            <th>Address</th>
            <th>timing</th>
            <th>Updated At</th>
            <th>Actions</th>
        </x-slot>

        <x-slot name="body">
            @foreach ($stores as $store)
                <tr>
                    <td>{{ $store->name }}</td>
                    <td>{{ $store->city->name }}</td>
                    <td>{{ $store->deals()->count() }}</td>
                    <td>{{ $store->address }}</td>
                    <td>{{ $store->timing }}</td>
                    <td>{{ $store->updated_at->diffForHumans() }}</td>
                    <td class="d-flex">
                        <a href="{{ route('store.edit', $store) }}"
                            class="btn btn-sm btn-primary mr-1" title="Edit">
                            Edit
                        </a>

                        <form action="{{ route('store.destroy', $store) }}" method="POST" class="delete_store_form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger " title="Delete" >
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </x-slot>
    </x-datatable.basic>

    <x-slot name="scripts">
        <script>


              $('.delete_store_form').on('submit', function(e) {
                e.preventDefault();

                var form = this;
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    allowOutsideClick: false,
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });

            });
        </script>

    </x-slot>

</x-master>
