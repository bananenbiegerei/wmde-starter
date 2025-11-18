<h3>Buttons</h3>
<div class="space-y-5" x-data="{
	colors: ['primary', 'secondary', 'accent', 'warning', 'error', 'success', 'neutral'],
	sizes: ['xl', 'lg', 'default', 'md', 'sm', 'xs']
}">
    <h4 class="mb-0">Colors</h4>
    <div class="btn-group">
        <template x-for="(color, index) in colors" :key="index">
            <button :class="`btn btn-${color}`" x-text="color"></button>
        </template>
    </div>
    <hr>
    <h4 class="mb-0">State: active</h4>
    <h4 class="mb-0">State: disabled</h4>
    <hr>
    <h4 class="mb-0">Ghots</h4>
    <div class="btn-group">
        <template x-for="(color, index) in colors" :key="index">
            <button :class="`btn btn-ghost btn-${color}`" x-text="color"></button>
        </template>
    </div>
    <hr>
    <h4 class="mb-0">Outline</h4>
    <div class="btn-group">
        <template x-for="(color, index) in colors" :key="index">
            <button :class="`btn btn-outline btn-${color}`" x-text="color"></button>
        </template>
    </div>
    <hr>
    <h4 class="mb-0">Sizes</h4>
    <div class="btn-group">
        <template x-for="(size, index) in sizes" :key="index">
            <button :class="`btn btn-primary btn-${size}`" x-text="`Button ${size}`"></button>
        </template>
    </div>
    <hr>
    <h4 class="mb-0">Sizes with icons before</h4>

    <button class="btn btn-xl">
        <span class="bb-icon icon-xl">
            <!--?xml version="1.0" encoding="utf-8"?-->
            <svg width="20" height="20" viewBox="0 0 20 20" role="presentation" aria-hidden="true">
                <path d="M17 9.96296L12.1601 17H10.3128L14.4877 10.7407H2V9.22222H14.4877L10.3128 3H12.1601L17 9.96296Z"
                    fill="currentColor">
                </path>
            </svg>
        </span>
        XLarge
    </button>
    <button class="btn btn-lg">
        <span class="bb-icon icon-lg">
            <!--?xml version="1.0" encoding="utf-8"?-->
            <svg width="20" height="20" viewBox="0 0 20 20" role="presentation" aria-hidden="true">
                <path d="M17 9.96296L12.1601 17H10.3128L14.4877 10.7407H2V9.22222H14.4877L10.3128 3H12.1601L17 9.96296Z"
                    fill="currentColor"></path>
            </svg>
        </span>
        Large
    </button>
    <button class="btn">
        <span class="bb-icon icon-base">
            <!--?xml version="1.0" encoding="utf-8"?-->
            <svg width="20" height="20" viewBox="0 0 20 20" role="presentation" aria-hidden="true">
                <path d="M17 9.96296L12.1601 17H10.3128L14.4877 10.7407H2V9.22222H14.4877L10.3128 3H12.1601L17 9.96296Z"
                    fill="currentColor"></path>
            </svg>
        </span>
        Normal
    </button>
    <button class="btn btn-sm">
        <span class="bb-icon icon-sm">
            <!--?xml version="1.0" encoding="utf-8"?-->
            <svg width="20" height="20" viewBox="0 0 20 20" role="presentation" aria-hidden="true">
                <path d="M17 9.96296L12.1601 17H10.3128L14.4877 10.7407H2V9.22222H14.4877L10.3128 3H12.1601L17 9.96296Z"
                    fill="currentColor"></path>
            </svg>
        </span>
        Small
    </button>
    <button class="btn btn-xs">
        <span class="bb-icon icon-xs">
            <!--?xml version="1.0" encoding="utf-8"?-->
            <svg width="20" height="20" viewBox="0 0 20 20" role="presentation" aria-hidden="true">
                <path d="M17 9.96296L12.1601 17H10.3128L14.4877 10.7407H2V9.22222H14.4877L10.3128 3H12.1601L17 9.96296Z"
                    fill="currentColor"></path>
            </svg>
        </span>
        Tiny
    </button>
    <hr>
    <h4 class="mb-0">Buttons with different HTML Tags</h4>
    <code class="block p-2 rounded bg-warning-100">
		Radio and checkbox not refinded yet. Because of complications with forms.
		Let's see if we need it.
	</code>
    <a role="button" class="btn">Link</a>
    <button type="submit" class="btn">Button</button>
    <input type="button" value="Input" class="btn" />
    <input type="submit" value="Submit" class="btn" />
    <input type="radio" aria-label="Radio" class="btn" />
    <input type="checkbox" aria-label="Checkbox" class="btn" />
    <input type="reset" value="Reset" class="btn" />
</div>