@extends('layouts.layout')

@section('title', 'Book List')

@section('style')
    <style>
        .thumbnail {
            height: 100px;
        }

        .card-img-top {
            height: 300px;
            object-fit: contain;
        }

        .book {
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%);
            transition: 0.3s;
            margin: 20px 0;
        }

        .book-list {
            display: table;
            width: 100%;
            margin: 15px 0;
        }

        .book-list .book {
            display: table-cell;
            padding: 16px;
        }

        .cs-pagination li.page-item{
            margin: 0 4px;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="head py-3 d-flex justify-content-between align-items-center">
            <h2>Book List</h2>
            <div class="buttons">
                <a href="{{ route('getBooks') }}" class="btn btn-primary">Import Books</a>
                <a href="{{ route('logout') }}" class="btn btn-secondary">Logout</a>
            </div>
        </div>

        {{-- Alert Error --}}
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Alert Error --}}
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- Book List :: Start --}}
        <section class="pb-3 pt-1">
            @if ($books)
                <div class="row">
                    @foreach ($books as $book)
                        @php
                            $image = '';
                            if ($book['thumbnail']) {
                                $image = $book['thumbnail'];
                            } elseif ($book['small_thumbnail']) {
                                $image = $book['small_thumbnail'];
                            }
                        @endphp
                        <div class="book-list col-lg-4 col-md-6 col-sm-12">
                            <div class="book">
                                <img src="{{ $image }}" class="card-img-top" alt="{{ $book['title'] }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $book['title'] }}</h5>
                                    <p class="card-text"><b>{{ $book['subtitle'] }}</b></p>
                                    <p class="card-text">Authors: {{ $book['authors'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- Pagination --}}
                </div>
                <div class="cs-pagination d-flex align-items-center justify-content-center py-2 ">
                    {{ $books->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </section>
    {{-- Book List :: End --}}
    </div>
@endsection
