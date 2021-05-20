<!-- <div class="col-9">
                            <h1 class="px-2 py-4 font-effect__blue">RESULTADOS:</h1>

                            @if(isset($propriedades))

                            <div id="divResultsProp" class="container profile-container__searchOptions text-center p-2 position-relative">
                                @if(count($propriedades)>0)

                                @foreach($propriedades as $propInfo)
                                <div class="row">
                                    <div class="col h-25">
                                        <a href="{{ url('propriedades/' . $propInfo->IdPropriedade) }}">    
                                        </a>
                                    </div>
                                @endforeach

                                @else
                                <div class="row">
                                    <h1>No results found</h1>
                                </div>
                                
                                @endif
                            </div>
                            <div id="divResultsPropTeste" class="container profile-container__searchOptions p-2">
                              <div id="gridItem"></div>
                              <div id="gridItem"></div>
                              <div id="gridItem"></div>
                            </div>
                            @endif
                            <table class="table">
                                @if(count($propriedades) > 0)

                                @foreach ($propriedades as $propInfo)
                                <tr class="profile-container__searchOptions">
                                    <th scope="row">{{$propInfo['IdPropriedade']}}</th>
                                    <td>{{$propInfo['TipoPropriedade']}}</td>
                                    <td>{{$propInfo['Localizacao']}}</td>
                                    <td>{{$propInfo['AreaMetros']}} m<sup>2</sup></td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>No results found!</td>
                                </tr>
                                @endif

                            </table>
                           

                            <div>
                                {{ $propriedades->links('pagination::bootstrap-4') }}
                            </div>
                        </div> -->









                        <div class="row">
                                <div class="col-md-12">
                                    <br />
                                    <h3 align="center">Property Data</h3>
                                    <br />
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Id</th>
                                            <th>Type</th>
                                            <th>Location</th>
                                            <th>Area</th>
                                            <th>Price</th>
                                        </tr>
                                    @foreach($propriedades as $row)
                                    <tr>
                                        <td>{{$row['IdPropriedade']}}</td>
                                        <td>{{$row['TipoPropriedade']}}</td>
                                        <td>{{$row['Localizacao']}}</td>
                                        <td>{{$row['AreaMetros']}}m2</td>
                                        <td>{{$row['Preco']}}</td>
                                    </tr>
                                    @endforeach
                                    </table>
                                </div>
                            </div>  