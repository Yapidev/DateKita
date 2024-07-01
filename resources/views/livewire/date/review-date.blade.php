<div>
    @push('style')
        <style>
            input[type="radio"] {
                opacity: 0;
                display: none;
            }

            .rating {
                display: flex;
                justify-content: center;
                gap: 5px;
            }

            .star {
                cursor: pointer;
                font-size: 2rem;
                position: relative;
            }

            .star-rating {
                cursor: pointer;
                font-size: 2rem;
                position: relative;
            }
        </style>
    @endpush

    <div class="row">
        {{-- Rating Form --}}
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header text-bg-warning">
                    <h4 class="mb-0 text-white card-title">{{ $date->getAuthRating() ? 'Ubah Rating' : 'Beri Rating' }}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        {{-- Stars --}}
                        @for ($i = 1; $i <= 5; $i++)
                            <label class="star" data-value="{{ $i }}"
                                x-on:click="$wire.rating = {{ $i }}" wire:ignore>
                                <input type="radio" name="rating" value="{{ $i }}"
                                    class="rating-input d-none @error('rating') is-invalid @enderror">
                                <i class="fas fa-star"></i>
                            </label>
                        @endfor
                        {{-- Stars --}}
                    </div>
                    @error('rating')
                        <div class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    {{-- Coment --}}
                    <label for="coment" class="form-label">Komentar</label>
                    <textarea type="text" class="form-control mb-3 @error('comment') is-invalid @enderror" wire:model='comment'></textarea>
                    @error('comment')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    {{-- Coment --}}
                    <div class="d-flex justify-content-end">
                        <button wire:click="submitRating" class="btn btn-primary" wire:loading.delay.attr='disabled'>Submit
                            Rating</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Rating Form --}}
        {{-- Show Rating --}}
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header text-bg-secondary">
                    <h4 class="mb-0 text-white card-title">Daftar Review</h4>
                </div>
                <div class="card-body">
                    {{-- Ratings --}}
                    <div class="row">
                        @forelse ($ratings as $rating)
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <span class="position-relative">
                                        <img src="{{ asset($rating->users->showAvatar()) }}" alt="user1"
                                            width="48" height="48" class="rounded-circle" />
                                    </span>
                                    <div class="ms-3 d-inline-block w-75">
                                        {{-- Stars Kuning --}}
                                        @for ($i = 1; $i <= $rating->rating; $i++)
                                            <label class="star-rating" style="color: gold">
                                                <i class="fas fa-star"></i>
                                            </label>
                                        @endfor
                                        {{-- Stars Kuning --}}
                                        {{-- Stars Abu --}}
                                        @for ($i = 1; $i <= 5 - $rating->rating; $i++)
                                            <label class="star-rating" style="color: gray">
                                                <i class="fas fa-star"></i>
                                            </label>
                                        @endfor
                                        {{-- Stars Abu --}}
                                        <h6 class="mb-1 fw-semibold chat-title">
                                            {{ $rating->users->name }}
                                        </h6>
                                        <span class="fs-3 text-truncate text-body-color">{{ $rating->comment }}</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <p class="fs-2 mb-0 text-muted mt-3">
                                        @if ($rating->updated_at !== $rating->created_at)
                                            (Di edit)
                                            {{ $rating->updated_at->diffForHumans() }}
                                        @else
                                            {{ $rating->created_at->diffForHumans() }}
                                        @endif
                                    </p>
                                </div>
                                <hr>
                            </div>
                        @empty
                            <p>Belum ada rating.</p>
                        @endforelse
                    </div>
                    {{-- Ratings --}}
                </div>
            </div>
        </div>
        {{-- Show Rating --}}
    </div>

    @script
        <script>
            const stars = document.querySelectorAll('.star');
            let rating = @json($this->rating); // Mengambil rating dari Livewire

            stars.forEach(star => {
                star.addEventListener('mouseover', function() {
                    resetStars();
                    highlightStars(this.dataset.value);
                });

                star.addEventListener('mouseout', function() {
                    resetStars();
                    highlightStars(rating);
                });

                star.addEventListener('click', function() {
                    rating = this.dataset.value;
                    highlightStars(rating);
                    document.querySelector(`input[name="rating"][value="${rating}"]`).checked =
                        true;
                });
            });

            function resetStars() {
                stars.forEach(star => {
                    star.style.color = 'gray';
                });
            }

            function highlightStars(count) {
                for (let i = 0; i < count; i++) {
                    stars[i].style.color = '#ffca08';
                }

                console.log('jalan wak');
            }

            // Inisialisasi tampilan bintang sesuai dengan rating dari database
            highlightStars(rating);

            $wire.on('notify', data => {
                Swal.fire({
                    icon: data.icon,
                    title: data.title,
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false,
                });
            });
        </script>
    @endscript

</div>
