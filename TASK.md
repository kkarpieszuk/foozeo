W tym pliku znajduje się podsumowanie wykonania zadania rekrutacyjnego.

Podczas pracy nad zadaniem musiałem iść na kompromisy, dlatego będę bardzo wdzięczny za przeczytanie pliku do końca, by zrozumieć. Kompromisy, na które musiałem pójść wynikają z rozległości zadania i ograniczonego czasu, jaki mogłem poświęcić na jego wykonanie. Założyłem sobie także, że generowanie kodu przez AI jest oszukiwaniem w przypadku zadań rekrutacyjnych, więc cały kod pisałem ręcznie - co nie poprawilo sytuacji w kwestii braku czasu :)

# Wykorzystanie AI

Podczas racy nad zadaniem nie korzystałem z agentów AI w trybie generowania kodu. Jedyne wykorzystanie AI to:
- sporadyczne korzystanie z code completion podczas pisania kodu ręcznie do wypełnienia maksykmalnie 3-4 linii  kodu lub dokończenia bieżącej linii (uważam, że niewiele to się różni od pisania kodu w trybie manualnym z podpowiedziami w IDE)
- w cursor pracowałem czasem w trybie Ask (żaden kod nie jest generowany, można zadawać pytania o rozwiązania, AI odpowiada z propozycjami rożnych podejść do problemu), sczzególnie przy zadaniu odnośnie utworzenia bloku Gutenberga

# Szczegóły zadań

## Ogólne podejście

Projekt wykorzystuje Composer do generowania autoloderów (PSR-4). Podczas `composer install` lub `update` dodatkowo wykonuje polecenia `npm` związane z budowaniem blocka Gutenberga. Dodatkowo zdefiniowany jest skrypt `composer build` do generowania zipa w motywem.

Decydując się "wtyczka czy motyw" zdecydowałem się, że zadanie wykonam jako motyw WordPressa, szczególnie z uwagi na fakt, że większość podzadań to rozszerzanie funkcjonalności motywu Twenty Twenty-Five.

Plik `functions.php` traktuje jako punkt wyjścia z minimalną ilością kodu, większość funkcjonalności została zaimplementowana w osobnych klasach.

Pomimo, że 2025 to motyw FSE, szczególne szablony wykonałem w starym podejściu. Wynikało to z braku czasu i pewności: o wiele lepiej znam stare podejście. Nie jest dla mnie problemem tworzenie motywów FSE ale aby uniknąć sytuacji zablokowania z powodu braków w doświadczeniu, w reżimie krótkiego czasu zdecydowałem się na rozwiazania, które znam bardzo dobrze.

## Task 1 oraz 2 - wczytanie Assetów

Style definiwane są w standardowym pliku `style.css` motywu i automatycznie wczytywane za pomocą `get_header()`.

Skrypt js wczytywany jest przez klasę `Assets` w pliku `Assets.php`.

## Task 3 - rejestracja post type i taxonomii

Zaimplementowana została w pliku `PostTypes.php` w klasie `PostTypes`. Konfiguracja metod tworzących jest może nadmiarowa jeśli chodzi o parametry, jednak wolałem zrobic to od razu niż ewentualnie utknąć przy dalszej pracy.

## Task 4 - custom templates

Jak wspomniałem wcześniej, stworzyłem standardowe nie-FSE szablony umieszczone w `single-books.php` oraz `taxonomy-genres.php`. Dodatkowo kafelki z książami danego gatunku są w `template-parts/book-card.php`.

## Task 5 - custom gutenberg block.

Do scaffoldingu użyłem `npx @wordpress/create-block@latest`. Stworzyłem blok `foozeo/faq-accordion` który umożliwia tylko konfigurację tytułu sekcji oraz umieszczenie inner blocks.

Z uwagi na brak czasu nie implementowałem poszczególnych pytań/odpowiedzi, ani jako bloków potomnych, ani jako opcji konfiguracyjnych bloku. Zdecydowałem się, że blok foozeo/faq-accordion będzie używał standardowego bloku core/accordion-item jako bloków potomnych. Jedyne dostosowania:
- w pliku/klasie `Faq` w pliku `Faq.php` zaimplementowałem logikę ograniczającą bloki potomne do bloków core/accordion-item
- w tym samym pliku dodałem zmienianie wyswietlanego kodu HTML tak by posiadał odpowiednie atrybuty `data-...` (bez nich nie działało zwijanie/rozwijanie sekcji)
- w pliku `style.css` dodałem numerowanie sekcji za pomocą CSS counters (w wymaganiach było by zrobić to programistycznie, choć CSS nie jest językiem programowania to jednak uważam, że countery niewiele ustępują wyliczeniom w językach programowania, a wymagają mniej kodu).

Nie zmieniałem standardowego znaku + plusa do rozwijania sekcji na chevron.


