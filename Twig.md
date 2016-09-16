* Alguns Comandos Twig

´´´php
{% extends '@layout/default.html.twig' %}

{% block content %}
    {{ app }}
    {% set var = "Zend-Expressive" %}
    {{ var }}
    {% set bar, boo = "Várias variáveis", 2016 %}
    {{ bar }}
    {{ boo }}
    
    {% set div %}
        <div>Zend Expressive - PHP4</div>
    {% endset %}
    {{ div }}
    
    Operações<br/>
    {% set numero = 8050.8 %}
    {{ "Primeira string " ~ " Segunda string" ~ numero }}
    
    Arrays<br/>
    {% set arr = [3, 4, 5, 6, 7, 10] %}
    {{ arr[2] }}
    
    {% set arr_associativo = {"k1":"value1", "k2":"Value2"} %}
    {{ arr_associativo.k1 }}
    {{ arr_associativo["k2"] }}
    
    Loops<br/>
    {% for item in arr %}
        {{item}}<br />
    {% endfor %}
    
    {% for key,value in arr_associativo %}
        {{loop.index}} - {{key}} : {{value}}<br />
    {% endfor %}
    
    {% for i in 0..20 %}
        {{ i }}<br />
    {% endfor %}
    
    {% for v in 'a'..'z' %}
        {{ loop.index }} - {{ v }}
    {%endfor%}
    
    {% for v in 'a'..'z' %}
        {{ loop.index0 }} - {{ v }}
    {%endfor%}
    
    
    Filtros<br/>
    {% set negrito = "<b>Testes</b>" %}
    {{ negrito | raw }}<br>
    Data: {{ "now" | date('d/m/Y') }}
    
    Tags para Classe<br>
    {% do minhaClasse.setName("Nome 1") %}
    {{ minhaClasse.getName() }}
    
{% endblock %}
```