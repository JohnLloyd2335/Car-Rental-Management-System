<div>


    <div class="accessories-table-container">
        <div class="table-button-header-container">
            <a class="bg-main" href="{{ route('accessory.create') }}">Add Accessories</a>
            <div class="table-filter">
                <div>
                    <label>Filter by Date Added</label>
                    <select wire:model.change="orderBy">
                        <option value="ASC">Ascending</option>
                        <option value="DSC">Descending</option>
                    </select>
                </div>
                <div>
                    <label>Search</label>
                    <input type="text" name="search" wire:model.live.debounce.250ms="keywords">
                </div>
            </div>
        </div>
        <div class="table-container">
            <table id="accessoryDataTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($accessories as $accessory)
                        <tr>
                            <td>{{ $accessory->name }}</td>
                            <td>{{ date('M d, Y h:i A', strtotime($accessory->created_at)) }}</td>
                            <td>
                                <a href="{{ route('accessory.edit', $accessory) }}" class="bg-primary"><i
                                        class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Record Found</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

            <div>
                {{ $accessories->links('vendor.livewire.bootstrap') }}
            </div>
        </div>
    </div>


</div>
