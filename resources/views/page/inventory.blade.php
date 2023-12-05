@include('components.admin-header')
@include('components.background')
@include('components.admin-sidebar')
<div class="main">
    @include('components.admin-navbar')
    <div class="d-flex flex-column p-3 overflow-hidden" id="mainContent">
        <h1>Inventory</h1>
        <div class="d-flex flex-row gap-2">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInventory"><span
                    class="material-symbols-outlined">
                    add
                </span>Add</button>
            <button class="btn btn-primary" onclick="printData()"><span class="material-symbols-outlined">
                    print
                </span>Print</button>
        </div>

        <form action="{{ route('inventoryPage') }}" method="GET" class="mt-3">
            <div class="d-flex flex-row gap-2">
                <div class="d-flex flex-column">
                    <label for="" style="color: white;">Start Date</label>
                    <input class="rounded p-1" type="date" name="startDate" id="" value="{{ Session::get('startDate') }}">
                </div>
                <div class="d-flex flex-column">
                    <label for="" style="color: white;">End Date</label>
                    <input class="rounded p-1" type="date" name="endDate" id="" value="{{ Session::get('endDate') }}">
                </div>
                <div class="d-flex align-items-end">
                    <button type="submit" class="btn btn-primary d-flex">Submit</button>
                </div>
            </div>

            <div class="table-responsive mt-3 rounded">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Item</th>
                            <th>Total PCS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($datas) > 0)
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->item }}</td>
                                    <td>{{ $data->total }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2">Date hasn't been picked</td>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        @if($dataResult > 0)
                            <tr>
                                <td>Grand Total:</td>
                                <th>{{ $dataResult }}</th>
                            </tr>
                        @endif
                    </tfoot>
                </table>
            </div>

            <select class="mt-3 p-1 rounded" name="option" onchange="this.form.submit()">
                <option value="desc" {{ Request::input('option') == 'desc' ? 'selected' : '' }}>Newest To Oldest
                </option>
                <option value="asc" {{ Request::input('option') == 'asc' ? 'selected' : '' }}>Oldest To Newest
                </option>
            </select>
        </form>

        <div class="table-responsive mt-3 rounded">
            <table class="table table-hover" id="printTable" border="1" cellpadding="10"
                style="border-collapse: collapse;>
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Date Received</th>
                        <th scope="col">Box_id</th>
                        <th scope="col">Item</th>
                        <th scope="col">Pcs</th>
                        <th scope="col">Buy_price</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->date_received }}</td>
                            <td>{{ $inventory->box_id }}</td>
                            <td>{{ $inventory->item }}</td>
                            <td>{{ $inventory->pcs }}</td>
                            <td>₱{{ number_format($inventory->buy_price) }}</td>
                            <td>
                                <div class="d-flex flex-row gap-3" id="editButtons">
                                    <span onclick="editModalData(this)" data-bs-toggle="modal"
                                        data-bs-target="#editInventory" data-id="{{ $inventory->id }}"
                                        data-date-received="{{ $inventory->date_received }}"
                                        data-box-id="{{ $inventory->box_id }}" data-item="{{ $inventory->item }}"
                                        data-pcs="{{ $inventory->pcs }}" data-buy-price="{{ $inventory->buy_price }}"
                                        style="--background-color: #cfe2ff" class="material-symbols-outlined edit-btn">
                                        edit
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Add Modal -->
<form action="{{ route('addInventoryRequest') }}" method="POST">
    @csrf
    <div class="modal fade" id="addInventory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><span class="material-symbols-outlined">
                            inventory_2
                        </span>Add Inventory</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger d-flex align-items-center">{{ $error }}</div>
                        @endforeach
                        <label for="">Date Received</label>
                        <input type="date" name="date" id="">
                        <label for="" class="mt-3">Box_id</label>
                        <input type="number" name="box_id" id="" value="1">
                        <label for="" class="mt-3">Item</label>
                        <input type="text" name="item" id="" placeholder="Item...">
                        <label for="" class="mt-3">Pcs</label>
                        <input type="number" name="pcs" id="" placeholder="Pcs...">
                        <label for="" class="mt-3">Buy Price</label>
                        <input type="number" name="buy_price" id="" placeholder="Buy Price...">
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Add Modal -->
<!-- Edit Modal -->
<form action="{{ route('editInventoryRequest') }}" method="POST">
    @csrf
    <div class="modal fade" id="editInventory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><span class="material-symbols-outlined">
                            inventory_2
                        </span>Edit Inventory</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger d-flex align-items-center">{{ $error }}</div>
                        @endforeach
                        <input class="d-none" type="text" name="id" id="editId" readonly>
                        <label for="">Date Received</label>
                        <input type="date" id="editDateReceived" name="date">
                        <label for="" class="mt-3">Box_id</label>
                        <input type="number" id="editBoxId" name="box_id" value="1">
                        <label for="" class="mt-3">Item</label>
                        <input type="text" id="editItem" name="item" placeholder="Item...">
                        <label for="" class="mt-3">Pcs</label>
                        <input type="number" id="editPcs" name="pcs" placeholder="Pcs...">
                        <label for="" class="mt-3">Buy Price</label>
                        <input type="number" id="editBuyPrice" name="buy_price" placeholder="Buy Price...">
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Edit Modal -->
<!--===============================================================================================-->
<script>
    document.title = 'Inventory';
</script>
<!--===============================================================================================-->
<script>
    @if ($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 2000,
            });
        });
    @endif
</script>
<!--===============================================================================================-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if ("{{ session('success') }}") {
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1000
            });
        }
    });
</script>
<!--===============================================================================================-->
<script>
    function editModalData(element) {
        const editId = element.getAttribute('data-id');
        const dateReceived = element.getAttribute('data-date-received');
        const boxId = element.getAttribute('data-box-id');
        const item = element.getAttribute('data-item');
        const pcs = element.getAttribute('data-pcs');
        const buyPrice = element.getAttribute('data-buy-price');

        document.getElementById('editId').value = editId;
        document.getElementById('editDateReceived').value = dateReceived;
        document.getElementById('editBoxId').value = boxId;
        document.getElementById('editItem').value = item;
        document.getElementById('editPcs').value = pcs;
        document.getElementById('editBuyPrice').value = buyPrice;
    }

    function printData() {
        var divToPrint = document.getElementById("printTable");
        var newWin = window.open("");
        newWin.document.write('<html><head><title>Print Table</title></head><body>');
        newWin.document.write(divToPrint.outerHTML);
        newWin.document.write('</body></html>');
        newWin.document.close();

        newWin.print();
        newWin.close();
    }
</script>
<!--===============================================================================================-->
@include('components.admin-footer')
