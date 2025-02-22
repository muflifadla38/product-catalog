<x-dashboard-layout>
    <div>
        <div class="d-flex align-items-end">
            <img alt="Profile picture" class="border border-secondary-subtle rounded-circle" height="125"
                src="{{ asset('assets/images/frame-98700.png') }}" />
            <button class="profile-pencil bg-transparent border-0 p-0">
                <ion-icon class="border border-secondary-subtle rounded-circle p-1" name="pencil-outline"
                    size="small"></ion-icon>
            </button>
        </div>
        <div class="my-4">
            <span class="fs-4 fw-semibold mb-0">{{ $user->name }}</span>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">
                Nama Kandidat
            </label>
            <div class="input-group mb-4">
                <span class="input-group-text bg-transparent border border-end-0">
                    <ion-icon name="at-outline"></ion-icon>
                </span>
                <input type="text" class="form-control shadow-none border rounded-1 border-start-0 ps-0"
                    id="name" name="name" placeholder="nama kandidat" value="{{ $user->name }}">
            </div>
        </div>
        <div class="col-md-6">
            <label class="form-label">
                Posisi Kandidat
            </label>
            <div class="input-group mb-4">
                <span class="input-group-text bg-transparent border border-end-0">
                    <ion-icon name="code-slash-outline"></ion-icon>
                </span>
                <input type="text" class="form-control shadow-none border rounded-1 border-start-0 ps-0"
                    id="position" name="position" placeholder="posisi kandidat" value="{{ $user->position }}">
            </div>
        </div>
    </div>
</x-dashboard-layout>
