<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-light">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="mb-0">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save" enctype="multipart/form-data">

                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Product Name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="description" class="col-md-4 col-form-label text-md-end text-start">Product Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model="description"></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="image" class="col-md-4 col-form-label text-md-end text-start">Product Image</label>
                            <div class="col-md-8">
                               
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" wire:model="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                 @if($existingImage)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $existingImage) }}" alt="Existing Image" class="img-thumbnail" style="max-width: 50px;">
                                    </div>
                                @endif

                                
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Save
                                </button>
                                @if($isEdit)
                                    <button wire:click="cancel" class="btn btn-danger ms-2">
                                        Cancel
                                    </button>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 offset-md-4">
                                <span wire:loading class="text-primary">Processing...</span>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    .card {
        border-radius: 10px;
    }
    .card-header {
        border-bottom: 1px solid #e5e5e5;
    }
    .card-body {
        padding: 20px;
    }
</style>
