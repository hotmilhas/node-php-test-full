<?php
    //LARAVEL FRAMEWORK
    use Illuminate\Support\Facades\Route;

    Route::post('/php/orders', function(Request $request, Ordem $ordem) {
        
        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/aplicacao#!/CotacaoDolarDia#eyJmb3JtdWxhcmlvIjp7IiR0b3AiOjEwMCwiJGZvcm1hdCI6Impzb24iLCJkYXRhQ290YWNhbyI6IjA3LTIwLTIwMTgifSwicGVzcXVpc2FkbyI6dHJ1ZSwiYWN0aXZlVGFiIjoiZGFkb3MiLCJncmlkU3RhdGUiOnsDMAM6W3sDQgMiBDAEIiwDQQN9LHsDQgMiBDEEIiwDQQN9LHsDQgMiBDIEIiwDQQN9XSwDMQM6e30sAzIDOltdLAMzAzp7fSwDNAM6e30sAzUDOnt9fSwicGl2b3RPcHRpb25zIjp7A2EDOnt9LANiAzpbXSwDYwM6NTAwLANkAzpbXSwDZQM6W10sA2YDOltdLANnAzoia2V5X2FfdG9feiIsA2gDOiJrZXlfYV90b196IiwDaQM6e30sA2oDOnt9LANrAzo4NSwDbAM6ZmFsc2UsA20DOnt9LANuAzp7fSwDbwM6IkNvbnRhZ2VtIiwDcAM6IlRhYmxlIn19';

        $data = array("moeda" => "USD", "dataCotacao" => "07-20-2018");

        $get_addr = $url .'?'.http_build_query($data);
        $ch = curl_init($get_addr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $gist = json_decode($result, true);

        $price = $gist->cotacaoCompra;
        $items = $request->get('value');
        $totalBrasileiro = number_format(array_sum($items), 2, '.', '');
        $totalGeral = number_format($total * $price->value[0]->cotacaoCompra, 2, '.','');


        $criaOrdem = Ordem::create([
            'created_at' => Carbon::Now,
            'total_brl' => (float)$totalBrasileiro,
            'total_usd' => (float)$totalGeral
        ]);

        return response('Ordem cadastrada com sucesso.', 200);
    });


    //Retornar todos os pedidos salvos
    Route::get('/php/orders', function(Request $request, Ordem $ordem) {
        $ordem->transform(function(content $ordem){
            return [
                'id'  => $ordem->id,
                'tema'          => $ordem->tema->nome,
                'autor'         => $ordem->autor->pessoa->nome,
                'banner_path'   => $ordem->banner_path,
                'miniatura_path' => $ordem->miniatura_path,
                'titulo'        => $ordem->titulo,
                'subititulo'   => $ordem->subititulo,
                'resumo'  => $ordem->resumo,
                'descricao' => $ordem->descricao,
                'ano' => $ordem->ano,
                'tags' => $ordem->tags,
                'links' => $ordem->links,
                'embedded' => $ordem->embedded,
                'data_publicacao' => $ordem->data_publicacao,
                'data_expiracao' => $ordem->status,
                'destaque' => $ordem->destaque,
                'status' => $ordem->status
            ];
        });
        return response($ordem);

    });


    


