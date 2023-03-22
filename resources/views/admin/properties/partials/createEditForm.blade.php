<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <form action="{{ route($routeName, $property) }}" method="POST" enctype="multipart/form-data" class="py-3">
                @csrf
                @method($method)

                <div class="card px-4 px-md-5 py-3 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <h5>Seleziona i Servizi offerti dal tuo appartamento</h5>
                        </div>
                            @foreach ($services as $service)
                                <div class="form-check form-switch col-sm-12 col-lg-6">
                                    <input class="form-check-input service" role="switch" type="checkbox" name="services[]" id="{{$service->id}}" value="{{$service->id}}" @checked($property->services->contains($service->id))>
                                    <label for="{{$service->id}}">{{$service->title}}</label>
                                </div>
                                @error('service')
                                    <div class="invalid-feedback px-2">
                                        <i class="fa-solid fa-circle-exclamation pe-1"></i>{{ $message }}
                                    </div>
                                @enderror                  
                            @endforeach 
                    </div>
                    <div class="row">
                        <div class="form-outline mb-3 col-12">
                            <label for="title" class="form-label @error('title') is-invalid @enderror">Titolo:</label>
                            <input type="text" class="form-control" id="title" placeholder="Insert title" name="title" value="{{old('title', $property->title)}}">
                            @error('title')
                                <div class="invalid-feedback px-2">
                                    <i class="fa-solid fa-circle-exclamation pe-1"></i>{{ $message }}
                                </div>
                            @enderror                  
                        </div>
                    </div>

                    <div class="form-outline mb-3 col-12">
                        <label for="description" class="form-label @error('description') is-invalid @enderror">Descrizione:</label>            
                        <textarea class="d-block form-control" name="description" id="description" placeholder="Insert description">{{old('description', $property->description)}}</textarea>
                        @error('description')
                            <div class="invalid-feedback px-2">
                                <i class="fa-solid fa-circle-exclamation pe-1"></i>{{ $message }}
                            </div>
                        @enderror               
                    </div>
                    <div class="row">

                        <div class="form-outline mb-3 col-sm-12 col-md-6">
                            <label for="night-price" class="form-label @error('night_price') is-invalid @enderror">Prezzo per notte:</label>
                            <input type="number" class="form-control" id="night-price" placeholder="Insert price per night" name="night_price" value="{{old('night_price', $property->night_price)}}">               
                            @error('night_price')
                                <div class="invalid-feedback px-2">
                                    <i class="fa-solid fa-circle-exclamation pe-1"></i>{{ $message }}
                                </div>
                            @enderror               
                        </div>
    
                        <div class="form-outline mb-3 col-sm-12 col-md-6">
                            <label for="beds-number" class="form-label @error('n_beds') is-invalid @enderror">Numero di letti:</label>
                            <input type="number" class="form-control" id="beds-number" placeholder="Insert number of beds" name="n_beds" value="{{old('n_beds', $property->n_beds)}}">
                            @error('n_beds')
                                <div class="invalid-feedback px-2">
                                    <i class="fa-solid fa-circle-exclamation pe-1"></i>{{ $message }}
                                </div>
                            @enderror               
                        </div>
    
                        <div class="form-outline mb-3 col-sm-12 col-md-6">
                            <label for="n_toilettes" class="form-label @error('n_beds') is-invalid @enderror">Numero di bagni:</label>
                            <input type="number" class="form-control" id="n_toilettes" placeholder="Insert number of bathroom" name="n_toilettes" value="{{old('n_toilettes', $property->n_toilettes)}}">
                            @error('n_toilettes')
                                <div class="invalid-feedback px-2">
                                    <i class="fa-solid fa-circle-exclamation pe-1"></i>{{ $message }}
                                </div>
                            @enderror               
                        </div>
    
                        <div class="form-outline mb-3 col-sm-12 col-md-6">
                            <label for="rooms-number" class="form-label @error('n_rooms') is-invalid @enderror">Numero di stanze:</label>
                            <input type="number" class="form-control" id="rooms-number" placeholder="Insert number of rooms" name="n_rooms" value="{{old('n_rooms', $property->n_rooms)}}">
                            @error('n_rooms')
                                <div class="invalid-feedback px-2">
                                    <i class="fa-solid fa-circle-exclamation pe-1"></i>{{ $message }}
                                </div>
                            @enderror               
                        </div>

                        <div class="form-outline mb-3 col-sm-12 col-md-6">
                            <label for="mq" class="form-label @error('mq') is-invalid @enderror">Superfie proprietà:</label>
                            <input type="text" class="form-control" id="mq" placeholder="Insert property surface in square meters" name="mq" value="{{old('mq', $property->mq)}}">
                            @error('mq')
                                <div class="invalid-feedback px-2">
                                    <i class="fa-solid fa-circle-exclamation pe-1"></i>{{ $message }}
                                </div>
                            @enderror               
                        </div>

                        <div class="form-outline mb-3 col-sm-12 col-md-6">
                            <label for="address" class="form-label @error('address') is-invalid @enderror">Indirizzo:</label>
                            <input type="text" class="form-control" id="address" placeholder="Insert property address" name="address" value="{{old('address', $property->address)}}">
                            @error('address')
                                <div class="invalid-feedback px-2">
                                    <i class="fa-solid fa-circle-exclamation pe-1"></i>{{ $message }}
                                </div>
                            @enderror               
                        </div>
    
                        <div class="form-check form-switch col-12 mb-2 mt-2">
                            <label for="visible" class="form-label @error('visible') is-invalid @enderror">Rendi visibile l'appartamento</label>
                            <input type="checkbox" class="form-check-input" role="switch" id="visible" placeholder="Insert visibility" name="visible"  value="{{old('visible', 1)}}  @checked($property->visible)">
                            @error('visible')
                                <div class="invalid-feedback px-2">
                                    <i class="fa-solid fa-circle-exclamation pe-1"></i>{{ $message }}
                                </div>
                            @enderror               
                        </div>
                    </div>


                    @if (Route::is('admin.properties.edit'))
                        <h6 class="mb-2">Aggiungi altre immagini al tuo annuncio</h6>
                        <iframe src="/multi-image" frameborder="0"></iframe>
                    @endif
                    
                    <div class="form-outline my-3 col-12">
                        <label for="cover_img" class="form-label @error('cover_img') is-invalid @enderror">Imgagine di copertina </label>
                        <input type="file" class="form-control" id="cover_img" placeholder="Insert cover image" name="cover_img" value="{{old('cover_img', $property->cover_img)}}">
                        @error('cover_img')
                            <div class="invalid-feedback px-2">
                                <i class="fa-solid fa-circle-exclamation pe-1"></i>{{ $message }}
                            </div>
                        @enderror               
                    </div>
                </div>

                <div class="card-footer text-end pb-4 d-flex justify-content-between">
                    <a href="{{ route('admin.properties.index')}}" class="btn btn-dark rounded-circle"><i class="fa-solid fa-angles-left"></i></a>
                    <button type="submit" class="btn btn-success rounded-circle"><i class="fa-solid fa-plus"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
