<div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
            <div class="card-header ui-sortable-handle">
                <h4>Import Service Order Data from Excel</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div>{{ session('success') }}</div>
                @endif
                <form wire:submit.prevent="import">
                    <div class="row">
                        <div class="col-8 col-md-8 col-lg-8">
                            <div class="custom-file">
                                <input type="file" wire:model="file" class="custom-file-input" id="customFile">
                                @error('file')
                                    <div>{{ $message }}</div>
                                @enderror
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-4 col-lg-4">
                            <button type="submit" class="btn btn-block btn-icon icon-left btn-primary"><i
                                    class="fas fa-upload"></i> Upload</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <tbody>
                            <tr>
                                <th>Contract #</th>
                                <th>Name</th>
                                <th>Geo Community</th>
                                <th>Geo Zone</th>
                                <th>Tariff</th>
                                <th>Tariff Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @forelse ($serviceOrders as $order)
                                <tr>
                                    <td>{{ $order->cnumber }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->geo_community }}</td>
                                    <td>{{ $order->geo_zone }}</td>
                                    <td>{{ $order->tariff }}</td>
                                    <td>{{ $order->tariff_category }}</td>
                                    <td>
                                        <div class="badge badge-success">{{ $order->contract_status }}</div>
                                    </td>
                                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                                </tr>
                            @empty
                                <tr>No Record Found</tr>
                            @endforelse

                        </tbody>
                    </table>
                    <div>
                        {{ $serviceOrders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
