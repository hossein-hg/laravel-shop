@extends('admin.layouts.master')

@section('head-tag')
<title>منو</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">منو</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش منو</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش منو
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.menu.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.content.menu.update',[$menu->id])}}" method="post">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name">عنوان منو</label>
                                <input name="name" value="{{old('name',$menu->name)}}" id="name" type="text" class="form-control form-control-sm">
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">منو والد</label>
                                <select name="parent_id" id="" class="form-control form-control-sm">
                                    <option value="">منو اصلی </option>
                                    @foreach($menus as $parent_menu)
                                    <option @if($parent_menu->id == old('parent_id',$menu->parent_id)) selected  @endif value="{{$parent_menu->id}}">{{$parent_menu->name}}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="url">آدرس URL</label>
                                <input name="url" id="url" value="{{old('url',$menu->url)}}" type="text" class="form-control form-control-sm">
                                @error('url')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select  name="status" id="status" class="form-control form-control-sm @error('status') border-danger @enderror">
                                    <option value="0" @if(old('status',$menu->status) == 0) selected @endif>غیر فعال</option>
                                    <option value="1" @if(old('status',$menu->status) == 1) selected @endif>فعال</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
