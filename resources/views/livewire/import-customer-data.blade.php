<div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
            <div class="card-header ui-sortable-handle">
                <h4>Import Customer Data from Excel</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div>{{ session('success') }}</div>
                @endif
                    <div class="row">
                        <div class="col-8 col-md-8 col-lg-6">
                            <div class="custom-file">
                                <input type="file" id="excelFileInput" accept=".xlsx, .xls" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-4 col-lg-3 d-none" id="loader">
                            <button type="submit" class="btn btn-block btn-icon icon-left btn-primary"><i
                                    class="fas fa-upload"></i>  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Importing Customers...</button>
                        </div>
                        
                        <div class="col-4 col-md-4 col-lg-3">
                            <button id="importCustomers" type="submit" class="btn btn-block btn-icon icon-left btn-primary"><i
                                    class="fas fa-download"></i>  Import</button>
                        </div>
                    </div>
                    <hr>
                    <div class="progress">
                        <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    
                    <!-- Add "d-none" class to hide the progress bar initially -->

                    
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <tbody>
                            <tr>
                                <th>Contract #</th>
                                <th>Name</th>
                                <th>Account #</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @forelse ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->cnumber }}</td>
                                    <td>{{ $customer->customer_name }}</td>
                                    <td>{{ $customer->account_number }}</td>
                                    <td>{{ $customer->gender }}</td>
                                    <td>
                                        <div class="badge badge-success">{{ $customer->contract_status }}</div>
                                    </td>
                                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                                </tr>
                            @empty
                                <tr>No Record Found</tr>
                            @endforelse

                        </tbody>
                    </table>
                    <div>
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
