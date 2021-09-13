@props([
    'url'
])

@php($message = "Unknown embed url : " . $url)
@php(Log::error($message))
<!-- {{ $message }} -->
