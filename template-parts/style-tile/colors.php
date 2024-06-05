<div class="grid grid-cols-4 gap-8 my-12" x-data="{ colors: ['primary', 'secondary', 'accent', 'neutral', 'error', 'success', 'warning'] }">
    <template x-for="(color, index) in colors" :key="index">
        <div :class="`bg-${color}-500 p-4`">
            <p x-text="color"></p>
            <div x-data="{ shades: [900, 800, 700, 600, 500, 400, 300, 200, 100] }">
                <div class="grid grid-cols-6">
                    <template x-for="shade in shades">
                        <div :class="`bg-${color}-${shade} p-2 flex justify-center items-center`" x-text="shade"></div>
                    </template>
                </div>
            </div>
    </template>
</div>