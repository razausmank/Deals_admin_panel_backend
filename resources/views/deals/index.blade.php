<x-master title="Deals" :breadcrumbs="[ 'Deals' => 'deal.index']">

    <x-flash />

    <x-datatable.basic title="List of Deals" button_link="deal.create"
        button_text="New Deal" table_id="deals_list_datatable">
        <x-slot name="header">
            <th>Title</th>
            <th>Store</th>
            <th>Published</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Updated At</th>
            <th>Actions</th>
        </x-slot>

        <x-slot name="body">
            @foreach ($deals as $deal)
                <tr>
                    <td>{{$deal->title}}</td>
                    <td>{{ $deal->store->name}}</td>
                    <td>{{ $deal->is_published ? 'Yes' : 'No' }}</td>
                    <td>{{ $deal->promotion_start_date }}</td>
                    <td>{{ $deal->promotion_end_date }}</td>
                    <td>{{ $deal->updated_at->diffForHumans() }}</td>
                    <td class="d-flex">

                        @if($deal->is_published)

                            <form action="{{ route('deal.unpublish', $deal) }}" method="POST" class="deal_publish_unpublish_form mr-1">
                                @csrf
                                @method('POST')
                                <button type="submit" class=" btn btn-sm btn-warning" title="Unpublish">
                                    Unpublish
                                </button>
                            </form>
                        @else
                            <form action="{{ route('deal.publish', $deal) }}" method="POST" class="deal_publish_unpublish_form mr-1">
                                @csrf
                                @method('POST')
                                <button type="submit" class=" btn btn-sm btn-success" title="Publish">
                                    publish
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('deal.edit', $deal) }}"
                            class="btn btn-sm btn-primary mr-1" title="Edit">
                            Edit
                        </a>

                        <form action="{{ route('deal.destroy', $deal) }}" method="POST" class="delete_deal_form">
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


              $('.delete_deal_form').on('submit', function(e) {
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


            $('.deal_publish_unpublish_form').on('submit', function(e) {
                e.preventDefault();

                var form = this;
                Swal.fire({
                    title: "Are you sure?",
                    allowOutsideClick: false,
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });

            });
        </script>

    </x-slot>

</x-master>
