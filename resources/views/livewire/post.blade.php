<div class="card">
    <div class="card-header">
            <h3 class="card-label">

                @if($this->post)
                Edit the Post
                @else
                Add A New Post
                @endif
            </h3>
    </div>
    <form wire:submit.prevent="savePost">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="title">Title:</label>
                    <input type="text" wire:model='text' class="form-control">
                    @error('text')
                        <div class="text-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="description">Description:</label>
                    <textarea wire:model='description' class="form-control"></textarea>
                    @error('description')
                    <div class="text-danger">
                        <p>{{ $message }}</p>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="status">Status:</label>
                    <select wire:model='status' class="form-control">
                        <option value="">Select</option>
                        @foreach ($this->statuses as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="text-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="file">File:</label>
                    <input type="file" wire:model='file' class="form-control">
                    @error('file')
                        <div class="text-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-success" type="submit">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
