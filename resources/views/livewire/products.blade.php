<div class="container mt-5">
    <div class="row justify-content-center">

        <!-- Flash Message -->
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Include Update or Create Component -->
        @include('livewire.updateOrCreate')

        <!-- Products Heading -->
        <div class="row justify-content-center text-center mt-4 mb-3">
            <!-- Heading here -->
        </div>  

        <!-- Product List Card -->
        <div class="card shadow-lg border-light">
            <div class="card-header bg-gradient-primary text-white">
                <h5 class="mb-0">Product List</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">S#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr wire:key="{{ $product->id }}">
                                <th scope="row">{{ $loop->iteration + $products->firstItem() - 1 }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                    @else
                                        <span class="text-muted">No image available</span>
                                    @endif
                                </td>
                                <td>
                                    <button wire:click="edit({{ $product->id }})" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>   
                                    <button wire:click="delete({{ $product->id }})" wire:confirm="Are you sure you want to delete this product?" class="btn btn-danger btn-sm ms-2">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-danger">
                                    <strong>No Product Found!</strong>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination Controls -->
                <div class="mt-3">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
