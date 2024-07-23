<div class="modal fade" id="form-create-request" tabindex="-1" aria-labelledby="formCreateRequestLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="formCreateRequestLabel">Create New Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('requests.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="request_type">Request Type</label>
                        <select name="request_type" id="modal_request_type" class="form-control" onchange="toggleItemInputModal()">
                            <option value="">Select Request Type</option>
                            <option value="anomali harga">Anomali Harga</option>
                            <option value="pengadaan barang">Pengadaan Barang</option>
                        </select>
                    </div>
                    
                    <div class="form-group" id="modal_itemSelect" style="display:none;">
                        <label for="item_id">Item</label>
                        <select name="item_id" id="modal_item_id" class="form-control">
                            <option value="">Select Item</option>
                            @foreach($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="modal_itemInput" style="display:none;">
                        <label for="item_name">Item Name</label>
                        <input type="text" name="item_name" id="modal_item_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="modal_price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="modal_description" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleItemInputModal() {
        const requestType = document.getElementById('modal_request_type').value;
        const itemSelect = document.getElementById('modal_itemSelect');
        const itemInput = document.getElementById('modal_itemInput');

        if (requestType === 'anomali harga') {
            itemSelect.style.display = 'block';
            itemInput.style.display = 'none';
        } else if (requestType === 'pengadaan barang') {
            itemSelect.style.display = 'none';
            itemInput.style.display = 'block';
        } else {
            itemSelect.style.display = 'none';
            itemInput.style.display = 'none';
        }
    }
</script>
