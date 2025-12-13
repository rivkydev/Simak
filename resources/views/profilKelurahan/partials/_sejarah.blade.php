<div class="space-y-6 text-[#0A142F]">
    <div>
        <h2 class="text-3xl font-bold">Sejarah Kelurahan {{ $kelurahan->nama }}</h2>

        @foreach(explode("\n\n", $data->deskripsi ?? '') as $paragraph)
            <p class="text-[#0A142F] text-justify mt-2">
                {{ trim($paragraph) }}
            </p>
        @endforeach
    </div>
</div>
