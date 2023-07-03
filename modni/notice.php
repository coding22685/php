<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
 
include($_SERVER['DOCUMENT_ROOT'].'/modni/simple_html_dom.php');
//simple_html_dom.php 파일 수정 필요합니다.
//https://mandu-mandu.tistory.com/358
 
 
function naver_cafe_article_parser($page_no){
  //작성자 M4ndU
 
  //카페 url
  //카페 링크 aaaaa처리
  //search.clubid, search.menuid 0 처리
  //하였기 때문에 본인 카페 링크및 게시판 확인하셔서 변경하셔야합니다.
  $url = "https://cafe.naver.com/ArticleList.nhn?search.clubid=29874834&search.menuid=23&userDisplay=10&search.cafeId=29874834&search.page=".$page_no;
 //https://cafe.naver.com/ArticleRead.nhn?clubid=30524522&page=1&menuid=7&boardtype=L&articleid=3&referrerAllArticles=false
 //https://cafe.naver.com/ArticleList.nhn?search.clubid=29874834&search.menuid=1&userDisplay=10&search.boardtype=L&search.specialmenutype=&search.totalCount=101&search.cafeId=29874834&search.page=1
  $html = file_get_html($url);
 
  $board = $html->find('div[class=article-board m-tcol-c]');
  foreach ($board[1]->find('tr') as $article) {
 
    @$article_title_link = $article->find('a[class=article]')[0];
    @$article_title = $article_title_link->plaintext;
    @$article_link = $article_title_link->href;
    @$article_publisher = $article->find('td[class=p-nick]')[0]->plaintext;
    @$article_date = $article->find('td[class=td_date]')[0]->innertext;
 
    if ($article_title == "") {
      continue;
    }
 
 
    echo "<tr>";
    echo "<td><a href=https://cafe.naver.com".$article_link.">".$article_title."</a></td>";
    echo "<td><a href=https://cafe.naver.com".$article_link.">".$article_publisher."</a></td>";
    echo "<td><a href=https://cafe.naver.com".$article_link.">".$article_date."</a></td>";
    echo "</tr>";
  }
}
?>
<link rel="stylesheet" href="../css/animate.css" />
<script src="../js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <table class="table  wow fadeInUp " data-wow-duration="1s">
        <thead>
            <th>글제목</th>
            <th>작성자</th>
            <th>등록일시</th>
        </thead>
<?php
for ($i=1; $i<=3 ; $i++) { // 파싱할 게시판의 최대 페이지를 고려하세요.
  naver_cafe_article_parser($i);
}
?>
</table>
<style>
      .table{
        width: 70%;
      }
      .table a:link {
            color: black;
            text-decoration: none;
        }
    
       .table a:visited {
            color: black;
            text-decoration: none;
        }
    
       .table a:hover {
            color: black;
            text-decoration: none;
            
        }
        #pages span{
          cursor:pointer;
        }
        @media screen and (max-width: 1024px) {
          .table{
        width: 90%;
      }
        }

</style>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
  $(document).ready(function() {
	$("tbody tr").hover(function() {
		$(this).find("td").addClass("hov");
	}, function() {
		$(this).find("td").removeClass("hov");
	});
	
	//페이지 단위 작업
	var rows = $("table").find("tbody tr").length;   //<tr>의 전체 수
	//alert(rows);
	var per_page = 10;
	var no_pages = Math.ceil(rows / per_page);    //페이지 수 얻기.
	//alert(no_pages);
	var pageNumbers = $("<div id='pages'></div>");
	for(var i = 0; i <no_pages; i++) {
		$("<span class='page'>"+(i+1) +"</span>").appendTo(pageNumbers);  //pageNumbers앞에 <span>태그를 밀어 넣었다.
	}
	pageNumbers.insertAfter("table"); //table 태그 앞에 pageNumbers안에 있는 내용이 들어간다.
	
	
	//페이지 링크 걸기
	$(".page").hover(function() {  //<span class='page'>"+(i+1) +"</span> 이녀석을 지칭함.
		$(this).addClass("hov");
	}, function() {
		$(this).removeClass("hov");
	});  
	
	$("table").find("tbody tr").hide();    //.find = table안에 있는 무엇을 찾는다.
	var t = $("table tbody tr");   //배열이다. 모든 tr이 튀어나온다. 13개. 
	for ( var j = 0; j <= per_page-1 ; j++) {  //먼저 5개 출력
		$(t[j]).show();
	}
	
	$("span").click(function(event) {
		$("table").find("tbody tr").hide();
		for ( var k = ($(this).text() -1 ) * per_page; k <= $(this).text() * per_page -1 ; k++) {  //$(this).text() = span태그의 값부터~~ 즉 , 1찍으면 1, 2찍으면 2, 3찍으면 3부터,,,
			$(t[k]).show();
		}
	});
	
}); 
  </script>
