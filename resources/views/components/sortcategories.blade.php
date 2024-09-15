@props(['categories'])


<h1 class="categoriesformat">Esamos Kategorijos</h1>
<ul class="categoriesformat"> 
   
    <li>
        <a href="/models" >Visi modeliai</a>
    </li>
    @foreach($categories as $category)
    
    <li>
        <a href="/models?categoryid={{ $category->category_id }}" >{{ $category->name }}</a>
    </li>
    @endforeach
</ul>