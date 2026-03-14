@php
$locales = [
    'tr' => 'Türkçe',
    'en' => 'English',
    'de' => 'Deutsch',
    'fr' => 'Français',
    'es' => 'Español',
    'pt' => 'Português',
    'it' => 'Italiano',
    'ru' => 'Русский',
    'zh_CN' => '中文',
    'ja' => '日本語',
    'ko' => '한국어',
    'ar' => 'العربية',
    'hi' => 'हिन्दी',
    'pl' => 'Polski',
    'nl' => 'Nederlands',
];
@endphp
<li class="nav-item dropdown me-2 me-xl-1">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <i class="icon-base ti tabler-language icon-lg"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end" style="max-height:350px;overflow-y:auto">
        @foreach($locales as $code => $name)
            <li>
                <a class="dropdown-item {{ app()->getLocale() == $code ? 'active' : '' }}"
                   href="{{ route('lang.switch', $code) }}">
                    {{ $name }}
                </a>
            </li>
        @endforeach
    </ul>
</li>
