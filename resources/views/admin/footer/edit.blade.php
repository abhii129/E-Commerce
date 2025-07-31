@php
    // Map of section keys to their respective form partials
    $layouts = [
        'customer_service_contact_us'       => 'contact',
        'customer_service_faqs'             => 'faq',
        'customer_service_shipping_policy'  => 'content',
        'customer_service_returns_exchanges'=> 'content',
        'about_us_our_story'                => 'our_story',
        'about_us_blog'                    => 'blog',
        'about_us_careers'                 => 'careers',
        'about_us_privacy_policy'          => 'content',
        'connect_with_us_facebook'           => 'social_link',
        'connect_with_us_instagram'          => 'social_link',
        'connect_with_us_twitter'            => 'social_link',
        'connect_with_us_pinterest'          => 'social_link',
        // add other mappings as needed
    ];
@endphp

@extends('layouts.admin') {{-- Assuming you have a base admin layout --}}

@section('title', 'Edit ' . ucwords(str_replace('_', ' ', $section_key)))

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">
        Edit {{ ucwords(str_replace('_', ' ', $section_key)) }}
    </h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Include the form partial dynamically --}}
    @includeIf('admin.footer.forms.' . ($layouts[$section_key] ?? 'content'), [
        'data' => $data,
        'section_key' => $section_key,
    ])
</div>
@endsection
