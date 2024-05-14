<div>


    <div class="category-table-container">
        <div class="table-button-header-container">
            <a class="bg-main" href="{{ route('category.create') }}">Add Category</a>
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
            <table id="categoryDataTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>No. of Cars</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->cars_count }}</td>
                            <td>{{ date('M d, Y h:i A', strtotime($category->created_at)) }}</td>
                            <td>
                                <a href="{{ route('category.edit', $category) }}" class="bg-primary"><i
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
                {{ $categories->links('vendor.livewire.bootstrap') }}
            </div>
        </div>
    </div>
</div>
