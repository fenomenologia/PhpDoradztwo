-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 04, 2025 at 05:15 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kwestionariusz`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cecha`
--

CREATE TABLE `cecha` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `cecha`
--

INSERT INTO `cecha` (`id`, `nazwa`, `opis`) VALUES
(1, 'Kierownicze', 'Osoby takie lubią podejmować się różnych funkcji i mieć kontrolę nad rzeczami. Lubią być odpowiedzialne za zadania wymagające planowania, podejmowani decyzji i koordynowania pracy innych. Potrafią dawać instrukcję i wskazówki. Lubią organizować swoją własną działalność. Spostrzegają siebie samych jako osoby o dużej niezależności i samokontroli.'),
(2, 'Społeczne', 'Osoby uspołecznione lubią mieć do czynienia z ludźmi zarówno w sytuacjach zawodowych jak i udzielają im pomocy. Chętnie opiekują się innymi i pomagają w rozpoznawaniu potrzeb i rozwiązaniu problemów. Osoby uspołecznione lubią pracować i współpracować z innymi. Preferują takie działania, które wymagają kontaktów interpersonalnych.'),
(3, 'Metodyczne', 'Osoby metodyczne lubią działać według jasnych i sprawdzonych metod realizacji zadań. Preferują pracę pod kierunkiem i kontrolują innych według otrzymanych instrukcji. Pracują rutynowo i wolą sytuacje pozbawione niespodzianek.'),
(4, 'Innowacyjne', 'Osoby innowacyjne lubią zgłębiać problemy i eksperymentować w trakcie pracy nad rozwiązaniem kolejnych zadań. Lubią przedmioty „ścisłe\". Podejmują wyzwania jakie stawiają im nowe i niespodziewane sytuacje. Łatwo przystosowują się do zmiennych warunków działania.'),
(5, 'Przedmiotowe', 'Osoby o takich zainteresowaniach chętnie pracują za pomocą narzędzi, maszyn urządzeń technicznych. Lubią naprawiać lub tworzyć przedmioty z różnych materiałów, wykorzystując w tej pracy opracowane i sprawdzone technologie. Interesują ich zasady działania i budowa różnych urządzeń.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `doradca`
--

CREATE TABLE `doradca` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `czy_aktywny` tinyint(1) NOT NULL,
  `data_utworzenia` date NOT NULL,
  `czy_admin` tinyint(1) NOT NULL,
  `nazwisko` varchar(40) DEFAULT NULL,
  `imie` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `doradca`
--



-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `doradztwo`
--

CREATE TABLE `doradztwo` (
  `id` int(11) NOT NULL,
  `id_klienta` int(11) NOT NULL,
  `id_doradcy` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `id_status` int(11) NOT NULL,
  `rodzaj_doradztwa` enum('zainteresowan','motywacji','uczenia','osobowosci') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `doradztwo`
--



-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient`
--

CREATE TABLE `klient` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `data_utworzenia` date NOT NULL,
  `imie` varchar(40) DEFAULT NULL,
  `nazwisko` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `klient`
--



-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania`
--

CREATE TABLE `pytania` (
  `id` int(11) NOT NULL,
  `nr_pytania` int(11) NOT NULL,
  `pytania` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `pytania`
--

INSERT INTO `pytania` (`id`, `nr_pytania`, `pytania`) VALUES
(1, 1, 'Czy chciałbyś mieć taką pracę, w której kierujesz, kontrolujesz i planujesz działanie innych pracowników'),
(2, 2, 'Czy bezinteresownie pomagasz innym?'),
(3, 3, 'Czy lubisz pracować nad jednym zadaniem dopóki go nie skończysz?'),
(4, 4, 'Czy lubisz mieć wiele spraw na głowie?'),
(5, 5, 'Czy lubisz konstruować i naprawiać różne rzeczy?'),
(6, 6, 'Czy lubisz brać na siebie odpowiedzialność za zadania i wywiązywać się z nich?'),
(7, 7, 'Czy lubisz pomagać kolegom w rozwiązywaniu problemów?'),
(8, 8, 'Czy wolałbyś taką pracę, gdzie zawsze będziesz miał pewność, czego się od Ciebie oczekuje?'),
(9, 9, 'Czy lubisz książki i programy popularnonaukowe, np. dziedziny astronomii czy biologii?'),
(10, 10, 'Czy potrafisz projektować, wymyślać lub tworzyć różne przedmioty?'),
(11, 11, 'Czy lubisz kierować działaniami innych ludzi?'),
(12, 12, 'Czy jesteś w stanie pomagać ludziom, którzy są zdenerwowani lub zmartwieni?'),
(13, 13, 'Czy projekty lub inne prace wykonujesz dokładnie, krok po kroku?'),
(14, 14, 'Czy lubisz zagłębiać się w problemy, nad którymi pracujesz?'),
(15, 15, 'Czy masz jakieś własne hobby, które Cię pochłania?'),
(16, 16, 'Czy chciałabyś mieć taką pracę, gdzie byłbyś odpowiedzialny za podejmowanie decyzji?'),
(17, 17, 'Czy chciałbyś wykonywać pracę polegającą na pytaniu ludzi o ich opinie w sprawach różnych rzeczy lub wydarzeń?'),
(18, 18, 'Czy chciałbyś opierać się w swojej pracy na wyraźnie określonych zasadach i regułach?'),
(19, 19, 'Czy rozwiązując problemy chciałbyś zawsze opierać się na niepodważalnych faktach?'),
(20, 20, 'Czy lubisz grę w szachy i inne gry wymagające logicznego myślenia?'),
(21, 21, 'Czy pełniłeś kiedykolwiek rolę lidera w jakimś klubie, zespole lub organizacji?'),
(22, 22, 'Czy chciałbyś opiekować się ludźmi, którzy są chorzy albo mają jakieś problemy życiowe?'),
(23, 23, 'Czy lubisz pracować nad jednym zadaniem przez dłuższy czas?'),
(24, 24, 'Czy podobałaby Ci się praca, w której każdy dzień niósłby nowe i różnorodne zadania?'),
(25, 25, 'Czy jest dla Ciebie ważne, aby mieć większe osiągnięcia niż inni?'),
(26, 26, 'Czy jest dla Ciebie ważne, aby mieć większe osiągnięcia niż inni?'),
(27, 27, 'Czy chciałbyś mieć pracę, która jest związana z poprawą warunków socjalnych?'),
(28, 28, 'Czy lubisz pracować według otrzymanych wytycznych?'),
(29, 29, 'Czy chciałbyś wykonywać prace badawcze?'),
(30, 30, 'Czy chciałbyś pracować z materiałami takimi jak: drewno, kamień, glina, tkanina, metal?'),
(31, 31, 'Czy lubisz być odpowiedzialny za projekt, zadanie, które wymaga dopilnowania różnych szczegółów, aby mogło zostać wykonane w całości?'),
(32, 32, 'Czy chciałbyś mieć prace związaną ze służbą dla określonego środowiska?'),
(33, 33, 'Czy chciałbyś mieć taką pracę, gdzie Twoje czynności są na ogół ściśle kontrolowane?'),
(34, 34, 'Czy jesteś w stanie radzić sobie w sytuacji, gdy nieustannie dzieje się coś nowego i niespodziewanego?'),
(35, 35, 'Czy chciałbyś być operatorem jakiegoś urządzenia?'),
(36, 36, 'Czy kiedyś byłeś odpowiedzialny za planowanie działań, które miał realizować ktoś inny?'),
(37, 37, 'Czy chciałbyś mieć stanowisko, które wymaga kontaktu z ludźmi cały dzień?'),
(38, 38, 'Czy podejmujesz się nowego zadania dopiero wtedy gdy skończysz poprzednie?'),
(39, 39, 'Czy lubisz realizować zadania, które pozwalają Ci odkrywać nowe fakty bądź prawidłowości?'),
(40, 40, 'Czy lubisz prace ręczne np. szycie, naprawa samochodu itp.?'),
(41, 41, 'Czy wolisz raczej kierować pracą grupy niż być jej członkiem?'),
(42, 42, 'Czy współpraca z ludźmi przychodzi Ci łatwo?'),
(43, 43, 'Czy chciałbyś mieć stanowisko, które wymaga stałego tempa pracy przez cały dzień?'),
(44, 44, 'Czy lubisz wypróbowywać różne, nawet niesprawdzone metody, aby całkowicie wykonać zadanie lub rozwiązać problem?'),
(45, 45, 'Czy cieszy Cię, kiedy dzięki książkom lub programom telewizyjnym możesz dowiedzieć się jak działają różne urządzenia?'),
(46, 46, 'Czy zwykle udaje Ci się nakłonić ludzi, żeby robili to czego Ty chcesz?'),
(47, 47, 'Czy lubisz doglądać pracy innych ludzi?'),
(48, 48, 'Czy umiesz przyjmować polecenia?'),
(49, 49, 'Czy lubisz takie działania, których wynik daje się obiektywnie zmierzyć?'),
(50, 50, 'Czy raczej wolałbyś pracę nie wymagającą kontaktu z ludźmi?');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania_motywacje`
--

CREATE TABLE `pytania_motywacje` (
  `id` int(11) NOT NULL,
  `tresc` text DEFAULT NULL,
  `nr_pytania` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pytania_motywacje`
--

INSERT INTO `pytania_motywacje` (`id`, `tresc`, `nr_pytania`) VALUES
(1, 'Wiem, w jakim kierunku chcę podnieść kwalifikacje.', 1),
(2, 'Mam dużo energii i zapału do podnoszenia kompetencji i zdobywania nowych umiejętności.', 2),
(3, 'Mam wysoką motywację do udziału w projekcie.', 3),
(4, 'Oceniam wysoko przydatność wybranego szkolenia przy poszukiwaniu  pracy.', 4),
(5, 'Chcę poszerzać swoje umiejętności planowania ścieżki zawodowej.', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania_osobowosc`
--

CREATE TABLE `pytania_osobowosc` (
  `id` int(11) NOT NULL,
  `tresc` text DEFAULT NULL,
  `rodzaj` enum('mocne','slabe') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pytania_osobowosc`
--

INSERT INTO `pytania_osobowosc` (`id`, `tresc`, `rodzaj`) VALUES
(1, 'SZCZERY', 'mocne'),
(2, 'UCZCIWY', 'mocne'),
(3, 'SKROMNY', 'mocne'),
(4, 'TRZEŹWO MYŚLĄCY', 'mocne'),
(5, 'NATURALNY', 'mocne'),
(6, 'PRAKTYCZNY', 'mocne'),
(7, 'GOSPODARNY', 'mocne'),
(8, 'MAŁOMÓWNY', 'mocne'),
(9, 'WYTRWAŁY W DZIAŁANIU', 'mocne'),
(10, 'NIEZWYKŁY', 'mocne'),
(11, 'ANALITYCZNY', 'mocne'),
(12, 'NIEZALEŻNY', 'mocne'),
(13, 'INTELEKTUALISTA', 'mocne'),
(14, 'WNIKLIWY', 'mocne'),
(15, 'SPOSTZREGAWCZY', 'mocne'),
(16, 'PROFESJONALNY', 'mocne'),
(17, 'DOKŁADNY', 'mocne'),
(18, 'KOMPETENTNY', 'mocne'),
(19, 'EMOCJONALNY', 'mocne'),
(20, 'TWÓRCZY', 'mocne'),
(21, 'DYNAMICZNY', 'mocne'),
(22, 'IMPULSYWNY', 'mocne'),
(23, 'WRAŻLIWY', 'mocne'),
(24, 'INTUICYJNY', 'mocne'),
(25, 'OTWARTY', 'mocne'),
(26, 'POMYSŁOWY', 'mocne'),
(27, 'OBDARZONY WYOBRAŹNIĄ', 'mocne'),
(28, 'UPRZEJMY', 'mocne'),
(29, 'PRZEKONYWUJĄCY', 'mocne'),
(30, 'ROZUMIEJĄCY INNYCH LUDZI', 'mocne'),
(31, 'CIERPLIWY', 'mocne'),
(32, 'POPIERAJĄCY', 'mocne'),
(33, 'WSPÓŁCZUJĄCY', 'mocne'),
(34, 'TAKTOWNY', 'mocne'),
(35, 'ODPOWIEDZIALNY', 'mocne'),
(36, 'TOWARZYSKI', 'mocne'),
(37, 'KONSEKWENTNY', 'mocne'),
(38, 'ODWAŻNY', 'mocne'),
(39, 'STANOWCZY', 'mocne'),
(40, 'ENERGICZNY', 'mocne'),
(41, 'CHARYZMATYCZNY', 'mocne'),
(42, 'PEWNY SIEBIE', 'mocne'),
(43, 'POPULARNY', 'mocne'),
(44, 'DBAJĄCY O ZYSK', 'mocne'),
(45, 'PRZYCIĄGAJĄCY UWAGĘ', 'mocne'),
(46, 'DOKŁADNY', 'mocne'),
(47, 'DOSTOSOWUJĄCY SIĘ', 'mocne'),
(48, 'CZUJNY', 'mocne'),
(49, 'SKUTECZNY', 'mocne'),
(50, 'OSTROŻNY', 'mocne'),
(51, 'PEDANTYCZNY', 'mocne'),
(52, 'LOJALNY', 'mocne'),
(53, 'PUNKTUALNY', 'mocne'),
(54, 'STARANNY', 'mocne'),
(55, 'FAŁSZYWY', 'slabe'),
(56, 'NIETAKTOWNY', 'slabe'),
(57, 'PRZEWRAŻLIWIONY', 'slabe'),
(58, 'ROZRZUTNY', 'slabe'),
(59, 'SAMOTNIK', 'slabe'),
(60, 'ROZTARGNIONY', 'slabe'),
(61, 'SKRYTY', 'slabe'),
(62, 'BOJAŹLIWY', 'slabe'),
(63, 'PLOTKUJĄCY', 'slabe'),
(64, 'NIEGOSPODARNY', 'slabe'),
(65, 'OBOJĘTNY', 'slabe'),
(66, 'LIZUS', 'slabe'),
(67, 'NERWOWY', 'slabe'),
(68, 'NIEODPOWIEDZALNY', 'slabe'),
(69, 'MANIPULANT', 'slabe'),
(70, 'LENIWY', 'slabe'),
(71, 'PESYMISTA', 'slabe'),
(72, 'NIESTARANNY', 'slabe'),
(73, 'APATYCZNY', 'slabe'),
(74, 'NIETOLERANCYJNY', 'slabe'),
(75, 'WYBREDNY', 'slabe'),
(76, 'CHAOTYCZNY', 'slabe'),
(77, 'KRYTYKUJĄCY', 'slabe'),
(78, 'DENERWUJĄCY', 'slabe'),
(79, 'BAŁAGANIARZ', 'slabe'),
(80, 'OBOJĘTNY', 'slabe'),
(81, 'WTRĄCAJĄCY', 'slabe'),
(82, 'IMPULSYWNY', 'slabe'),
(83, 'SKONCENTROWANY NA SOBIE', 'slabe'),
(84, 'NIETOWARZYSKI', 'slabe'),
(85, 'NIESPOKOJNY', 'slabe'),
(86, 'NIEUFNY', 'slabe'),
(87, 'OBRAŻAJĄCY SIĘ', 'slabe'),
(88, 'LĘKLIWY', 'slabe'),
(89, 'ZAMKNIĘTY W SOBIE', 'slabe'),
(90, 'ZAKŁAMANY', 'slabe'),
(91, 'PEWNY SIEBIE', 'slabe'),
(92, 'NIEŚMIAŁY', 'slabe'),
(93, 'GŁOŚNY', 'slabe'),
(94, 'RYZYKANT', 'slabe'),
(95, 'SKĄPY', 'slabe'),
(96, 'KŁÓTLIWY', 'slabe'),
(97, 'SPÓŹNIAJĄCY SIĘ', 'slabe'),
(98, 'PRZEBIEGŁY', 'slabe'),
(99, 'GADATLIWY', 'slabe'),
(100, 'NIEZORGANIZOWANY', 'slabe'),
(101, 'MAŁO KREATYWNY', 'slabe'),
(102, 'POZWALAJĄCY NA WSZYSTKO', 'slabe'),
(103, 'NIESKUTECZNY', 'slabe'),
(104, 'MŚCIWY', 'slabe'),
(105, 'APODYKTYCZNY', 'slabe'),
(106, 'KAPRYŚNY', 'slabe'),
(107, 'NIEKOMPETENTNY', 'slabe'),
(108, 'NIEOSTROŻNY', 'slabe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania_style`
--

CREATE TABLE `pytania_style` (
  `id` int(11) NOT NULL,
  `nr_pytania` int(11) DEFAULT NULL,
  `tresc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pytania_style`
--

INSERT INTO `pytania_style` (`id`, `nr_pytania`, `tresc`) VALUES
(1, 1, 'Kiedy pierwszy raz posługuję się nowym dla mnie sprzętem…'),
(2, 1, 'Czytam instrukcję'),
(3, 1, 'Słucham, ewentualnie dopytuję'),
(4, 1, 'Uczę się obsługi na zasadzie prób i błędów'),
(5, 2, 'Kiedy zgubiłem/am drogę…'),
(6, 2, 'Patrzę na mapę'),
(7, 2, 'Pytam ludzi o wskazówki'),
(8, 2, 'Idę „na czuja”, ewentualnie używam kompasu'),
(9, 3, 'Kiedy gotuję nową potrawę…'),
(10, 3, 'Podążam za instrukcjami w przepisie'),
(11, 3, 'Dzwonię do znajomego i proszę wytłumaczenie'),
(12, 3, 'Gotując, próbuję'),
(13, 4, 'By kogoś czegoś nauczyć…'),
(14, 4, 'Piszę instrukcje'),
(15, 4, 'Tłumaczę'),
(16, 4, 'Demonstruję i daję szansę na spróbowanie'),
(17, 5, 'Mówię zazwyczaj...'),
(18, 5, 'Widzę, o co Ci chodzi'),
(19, 5, 'Z tego, co słyszę…'),
(20, 5, 'Wiem, co czujesz'),
(21, 6, 'Zazwyczaj mówię…'),
(22, 6, 'Pokaż mi'),
(23, 6, 'Powiedz mi'),
(24, 6, 'Daj mi spróbować'),
(25, 7, 'Zazwyczaj mówię...'),
(26, 7, 'Zobacz jak to się robi'),
(27, 7, 'Wytłumaczę Ci'),
(28, 7, 'Spróbuj'),
(29, 8, 'Jak chcę się poskarżyć na wadliwy towar'),
(30, 8, 'Sporządzam pismo'),
(31, 8, 'Dzwonię'),
(32, 8, 'Wracam do sklepu, albo odsyłam wadliwy produkt do dyrektora'),
(33, 9, 'W czasie wolnym wolę'),
(34, 9, 'Muzea lub galerie'),
(35, 9, 'Muzykę lub rozmowy'),
(36, 9, 'Aktywność fizyczną'),
(37, 10, 'Kiedy idę na zakupy zazwyczaj…'),
(38, 10, 'Oglądam i wtedy decyduję'),
(39, 10, 'Pytam o radę obsługę'),
(40, 10, 'Próbuję, przymierzam'),
(41, 11, 'Wybierając wakacje'),
(42, 11, 'Czytam broszurki'),
(43, 11, 'Radzę się znajomych'),
(44, 11, 'Staram się wyobrazić sobie, jak to będzie'),
(45, 12, 'Wybierając nowy samochód'),
(46, 12, 'Czytam opinie'),
(47, 12, 'Rozmawiam ze znajomymi'),
(48, 12, 'Decyduję się na jazdę próbną samochodem, który mi się podoba'),
(49, 13, 'Ucząc się czegoś nowego'),
(50, 13, 'Patrzę, jak to robi nauczyciel, wykładowca, trener'),
(51, 13, 'Omawiam wszystko dokładnie krok po kroku'),
(52, 13, 'Próbuję sam/a to rozpracować'),
(53, 14, 'Wybierając z menu w restauracji...'),
(54, 14, 'Wyobrażam sobie, jak danie będzie wyglądało'),
(55, 14, 'Rozważam „różne pozycje w mojej głowie”'),
(56, 14, 'Zastanawiam się, jak to będzie smakowało'),
(57, 15, 'Słuchając muzyki…'),
(58, 15, 'Wyśpiewuję tekst w głowie lub na głos'),
(59, 15, 'Słucham tekstu i melodii'),
(60, 15, 'Wyobrażam sobie to, o czym śpiewają'),
(61, 16, 'Najlepiej zapamiętuję…'),
(62, 16, 'Robiąc notatki i przeglądając kartki'),
(63, 16, 'Czytając na głos powtarzając sobie w głowie najważniejsze punkty'),
(64, 16, 'Wyobrażając sobie treści, których się uczę i testując nową wiedzę w działaniu'),
(65, 17, 'Moje pierwsze wspomnienie dotyczy…'),
(66, 17, 'Widoku czegoś'),
(67, 17, 'Czyjegoś głosu'),
(68, 17, 'Robienia czegoś'),
(69, 18, 'Kiedy czegoś się obawiam...'),
(70, 18, 'Wyobrażam sobie najgorsze scenariusze'),
(71, 18, 'Omawiam problem w głowie'),
(72, 18, 'Nie mogę usiedzieć w miejscu, kręcę się to tu, to tam'),
(73, 19, 'Czuję się blisko z ludźmi, ze względu na to…'),
(74, 19, 'Jak wyglądają'),
(75, 19, 'Co do mnie mówią'),
(76, 19, 'Jak się przy nich czuję'),
(77, 20, 'Kiedy powtarzam materiał na egzamin…'),
(78, 20, 'Robię mnóstwo notatek, używając różnych kolorów'),
(79, 20, 'Czytam notatki, sobie lub znajomym'),
(80, 20, 'Wyobrażam sobie, jak piszę różne sformułowania, wzory'),
(81, 21, 'Kiedy komuś coś tłumaczę…'),
(82, 21, 'Pokazuję, o co mi chodzi'),
(83, 21, 'Opowiadam na różne sposoby, aż druga osoba zrozumie'),
(84, 21, 'Zachęcam, by ktoś zaczął to robić i w międzyczasie omawiam trudności'),
(85, 22, 'Moje główne zainteresowania to'),
(86, 22, 'Fotografia, oglądanie filmów'),
(87, 22, 'Słuchanie muzyki, radia, rozmowy ze znajomymi'),
(88, 22, 'Aktywność fizyczna, dobre wino, jedzenie, taniec, uprawiając sport'),
(89, 23, 'Większość wolnego czasu spędzam'),
(90, 23, 'Oglądając telewizję'),
(91, 23, 'Rozmawiając ze znajomymi'),
(92, 23, 'Na aktywności fizycznej, na pracach manualnych'),
(93, 24, 'Przy pierwszym kontakcie z jakąś osobą…'),
(94, 24, 'Organizuję spotkanie twarzą w twarz'),
(95, 24, 'Rozmawiam z nią przez telefon'),
(96, 24, 'Staram się coś wspólnie zrobić czy załatwić'),
(97, 25, 'Przy pierwszym kontakcie spostrzegam …'),
(98, 25, 'Jak osoba wygląda i jak jest ubrana'),
(99, 25, 'Jaki ktoś ma głos i jak mówi'),
(100, 25, 'Jaką osoba ma postawę i jak się porusza'),
(101, 26, 'Kiedy jestem bardzo zdenerwowany/a, to…'),
(102, 26, 'Odtwarzam sobie w głowie to, co mnie zdenerwowało'),
(103, 26, 'Wykrzykuję i mówię ludziom, co czuję'),
(104, 26, 'Tupię, trzaskam drzwiami, rzucam rzeczami'),
(105, 27, 'Najłatwiej zapamiętuję…'),
(106, 27, 'Twarze'),
(107, 27, 'Imiona'),
(108, 27, 'Rzeczy, które robiłem/am'),
(109, 28, 'Podejrzewam, że ktoś kłamie, gdy...'),
(110, 28, 'Widzę, że unika wzroku'),
(111, 28, 'Słyszę zmianę w tonie głosu'),
(112, 28, 'Czuję to'),
(113, 29, 'Kiedy widzę się ze starym przyjacielem'),
(114, 29, 'Mówię: “Jak dobrze Cię widzieć”'),
(115, 29, '“Jak dobrze wreszcie usłyszeć Twój głos”'),
(116, 29, 'Ściskam go lub podaję rękę');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `nazwa`) VALUES
(1, 'Nowy'),
(2, 'Zakonczony_kwestionariusz_zainteresowan'),
(3, 'Zakończony_kwestionariusz_motywacji'),
(4, 'zakonczony_kwestionariusz_stylow'),
(5, 'zakonczony_kwestionariusz_osobowosci');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `style_uczenia`
--

CREATE TABLE `style_uczenia` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(40) DEFAULT NULL,
  `tresc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `style_uczenia`
--

INSERT INTO `style_uczenia` (`id`, `nazwa`, `tresc`) VALUES
(1, 'Wzrokowiec', 'Uczy się korzystając z kolorowych plansz, wykresów. Myśląc ma tendencję do spoglądania w górę, słuchając potrzebuje kontaktu wzrokowego z mówcą. Ma dobrą pamięć do wizualnych elementów (do materiału wydrukowanego, narysowanego). Ucząc się siedzi dość spokojnie, zazwyczaj szybko mówi. Komunikaty werbalne zamienia na obraz. Uczy się szybko jeżeli informacje są uporządkowane. Gdy mówi jest dobrze widoczny. Zwraca uwagę na kolor, kształt, ładny wygląd stroju, mieszkania, książki..\r\n \r\nPodczas nauki pamiętaj...\r\nstwórz materiał graficzny tego co się uczysz\r\nsporządzaj mapy myśli\r\nwyobrażaj sobie dany problem i sposób jego rozwiązania\r\nrób notatki, używaj cienkopisów, mazaków, zakreślaczy\r\nPodczas nauki języków obcych pamiętaj...\r\nsporządzaj rysunki – znaczenia danych słówek\r\nsporządzaj mapy myśli\r\nzapisuj nowo poznane słowa\r\nsporządzaj karteczki, notatki, z nieznanymi słowami, naklejaj je na miejsca na które często patrzysz\r\nwyobrażaj sobie to słowo i jego znaczenie\r\nomawiaj scenki i rysunki, wyobrażaj sobie siebie mówiącego w obcym języku\r\n'),
(2, 'Słuchowiec', 'Uczy się zazwyczaj słuchając, mówiąc na głos. Potrzebuje ciągłych bodźców słuchowych, ale podczas nauki preferuje ciszę, bodźce słuchowe mogą nadmiernie koncentrować jego uwagę. Gdy mówi jest dobrze słyszany. Nie potrzebuje kontaktu wzrokowego z rozmówcą. Ma dobrą pamięć do dialogów, muzyki, dźwięków...\r\n\r\nPodczas nauki pamiętaj...\r\ntwórz mapy myśli i na głos omawiaj jej elementy\r\nczytaj tekst na głos\r\ndyskutuj z kimś o danym problemie, wytłumacz go i pozwól sobie go wytłumaczyć\r\nucz się w ciszy, muzyka czy inne hałasy mogą nadmiernie koncentrować Twoją uwagę\r\n\r\nPodczas nauki języków obcych pamiętaj...\r\nstaraj się dużo mówić w obcym języku, stwarzaj obcojęzyczną atmosferę, \r\nwypowiadaj na głos nieznane słowa, zwracając uwagę na ich wymowę\r\nnagrywaj nieznane słówka/zwroty i odtwarzaj je\r\noglądaj obcojęzyczne filmy, słuchaj obcojęzycznej stacji radiowej, śpiewaj obcojęzyczne piosenki\r\n'),
(3, 'Ruchowiec/Czuciowiec', 'Podczas nauki swobodnie rozsiada się, bawiąc się długopisem czy innym przedmiotem. Jest zaangażowany w aktywność ruchową, uczy się gdy ciało jest w ruchu. Gdy coś się dzieje ciekawego w otoczeniu wodzi za tym wzrokiem. Ma dobrą pamięć do działań i ruchów ciała. Patrząc na innych odczytuje ich mowę ciała. Lubi pracować w środowisku przyjaznym fizycznie i emocjonalnie.\r\nPodczas nauki pamiętaj...\r\nsporządzaj plan pracy, odgrywaj scenki, twórz wizualizację tego co się uczysz\r\njak się uczysz spaceruj, idź do parku\r\n\r\nPodczas nauki języków obcych pamiętaj...\r\nodgrywaj scenki w obcym języku\r\nczytaj nieznane słówka będąc w ruchu\r\nbierz do ręki przedmioty, których znaczenie w obcym języku chcesz zapamiętać\r\ngestykuluj podczas mówienia w obcym języku\r\n');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wynik`
--

CREATE TABLE `wynik` (
  `id` int(11) NOT NULL,
  `id_doradztwa` int(11) NOT NULL,
  `id_cechy` int(11) NOT NULL,
  `punkty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wynik_motywacje`
--

CREATE TABLE `wynik_motywacje` (
  `id` int(11) NOT NULL,
  `id_doradztwa` int(11) DEFAULT NULL,
  `punkty` int(11) DEFAULT NULL,
  `id_pytania` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wynik_osobowosc`
--

CREATE TABLE `wynik_osobowosc` (
  `id` int(11) NOT NULL,
  `id_doradztwa` int(11) DEFAULT NULL,
  `mocne_strony` text DEFAULT NULL,
  `slabe_strony` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wynik_style_uczenia`
--

CREATE TABLE `wynik_style_uczenia` (
  `id` int(11) NOT NULL,
  `id_doradztwa` int(11) DEFAULT NULL,
  `id_stylu` int(11) DEFAULT NULL,
  `punkty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cecha`
--
ALTER TABLE `cecha`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `doradca`
--
ALTER TABLE `doradca`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `doradztwo`
--
ALTER TABLE `doradztwo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doradztwo_id_doradcy_foreign` (`id_doradcy`),
  ADD KEY `doradztwo_id_klienta_foreign` (`id_klienta`),
  ADD KEY `doradztwo_id_status_foreign` (`id_status`);

--
-- Indeksy dla tabeli `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pytania`
--
ALTER TABLE `pytania`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pytania_motywacje`
--
ALTER TABLE `pytania_motywacje`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pytania_osobowosc`
--
ALTER TABLE `pytania_osobowosc`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pytania_style`
--
ALTER TABLE `pytania_style`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `style_uczenia`
--
ALTER TABLE `style_uczenia`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wynik`
--
ALTER TABLE `wynik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wynik_id_cechy_foreign` (`id_cechy`),
  ADD KEY `wynik_id_doradztwa_foreign` (`id_doradztwa`);

--
-- Indeksy dla tabeli `wynik_motywacje`
--
ALTER TABLE `wynik_motywacje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doradztwa` (`id_doradztwa`),
  ADD KEY `id_pytania` (`id_pytania`);

--
-- Indeksy dla tabeli `wynik_osobowosc`
--
ALTER TABLE `wynik_osobowosc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doradztwa` (`id_doradztwa`);

--
-- Indeksy dla tabeli `wynik_style_uczenia`
--
ALTER TABLE `wynik_style_uczenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doradztwa` (`id_doradztwa`),
  ADD KEY `id_stylu` (`id_stylu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cecha`
--
ALTER TABLE `cecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doradca`
--
ALTER TABLE `doradca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doradztwo`
--
ALTER TABLE `doradztwo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `klient`
--
ALTER TABLE `klient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pytania`
--
ALTER TABLE `pytania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `pytania_motywacje`
--
ALTER TABLE `pytania_motywacje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pytania_osobowosc`
--
ALTER TABLE `pytania_osobowosc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `pytania_style`
--
ALTER TABLE `pytania_style`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `style_uczenia`
--
ALTER TABLE `style_uczenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wynik`
--
ALTER TABLE `wynik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `wynik_motywacje`
--
ALTER TABLE `wynik_motywacje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wynik_osobowosc`
--
ALTER TABLE `wynik_osobowosc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wynik_style_uczenia`
--
ALTER TABLE `wynik_style_uczenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doradztwo`
--
ALTER TABLE `doradztwo`
  ADD CONSTRAINT `doradztwo_id_doradcy_foreign` FOREIGN KEY (`id_doradcy`) REFERENCES `doradca` (`id`),
  ADD CONSTRAINT `doradztwo_id_klienta_foreign` FOREIGN KEY (`id_klienta`) REFERENCES `klient` (`id`),
  ADD CONSTRAINT `doradztwo_id_status_foreign` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`);

--
-- Constraints for table `wynik`
--
ALTER TABLE `wynik`
  ADD CONSTRAINT `wynik_id_cechy_foreign` FOREIGN KEY (`id_cechy`) REFERENCES `cecha` (`id`),
  ADD CONSTRAINT `wynik_id_doradztwa_foreign` FOREIGN KEY (`id_doradztwa`) REFERENCES `doradztwo` (`id`);

--
-- Constraints for table `wynik_motywacje`
--
ALTER TABLE `wynik_motywacje`
  ADD CONSTRAINT `wynik_motywacje_ibfk_1` FOREIGN KEY (`id_doradztwa`) REFERENCES `doradztwo` (`id`),
  ADD CONSTRAINT `wynik_motywacje_ibfk_2` FOREIGN KEY (`id_pytania`) REFERENCES `pytania_motywacje` (`id`);

--
-- Constraints for table `wynik_osobowosc`
--
ALTER TABLE `wynik_osobowosc`
  ADD CONSTRAINT `wynik_osobowosc_ibfk_1` FOREIGN KEY (`id_doradztwa`) REFERENCES `doradztwo` (`id`);

--
-- Constraints for table `wynik_style_uczenia`
--
ALTER TABLE `wynik_style_uczenia`
  ADD CONSTRAINT `wynik_style_uczenia_ibfk_1` FOREIGN KEY (`id_doradztwa`) REFERENCES `doradztwo` (`id`),
  ADD CONSTRAINT `wynik_style_uczenia_ibfk_2` FOREIGN KEY (`id_stylu`) REFERENCES `style_uczenia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
=======
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 04, 2025 at 05:15 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kwestionariusz`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cecha`
--

CREATE TABLE `cecha` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `cecha`
--

INSERT INTO `cecha` (`id`, `nazwa`, `opis`) VALUES
(1, 'Kierownicze', 'Osoby takie lubią podejmować się różnych funkcji i mieć kontrolę nad rzeczami. Lubią być odpowiedzialne za zadania wymagające planowania, podejmowani decyzji i koordynowania pracy innych. Potrafią dawać instrukcję i wskazówki. Lubią organizować swoją własną działalność. Spostrzegają siebie samych jako osoby o dużej niezależności i samokontroli.'),
(2, 'Społeczne', 'Osoby uspołecznione lubią mieć do czynienia z ludźmi zarówno w sytuacjach zawodowych jak i udzielają im pomocy. Chętnie opiekują się innymi i pomagają w rozpoznawaniu potrzeb i rozwiązaniu problemów. Osoby uspołecznione lubią pracować i współpracować z innymi. Preferują takie działania, które wymagają kontaktów interpersonalnych.'),
(3, 'Metodyczne', 'Osoby metodyczne lubią działać według jasnych i sprawdzonych metod realizacji zadań. Preferują pracę pod kierunkiem i kontrolują innych według otrzymanych instrukcji. Pracują rutynowo i wolą sytuacje pozbawione niespodzianek.'),
(4, 'Innowacyjne', 'Osoby innowacyjne lubią zgłębiać problemy i eksperymentować w trakcie pracy nad rozwiązaniem kolejnych zadań. Lubią przedmioty „ścisłe\". Podejmują wyzwania jakie stawiają im nowe i niespodziewane sytuacje. Łatwo przystosowują się do zmiennych warunków działania.'),
(5, 'Przedmiotowe', 'Osoby o takich zainteresowaniach chętnie pracują za pomocą narzędzi, maszyn urządzeń technicznych. Lubią naprawiać lub tworzyć przedmioty z różnych materiałów, wykorzystując w tej pracy opracowane i sprawdzone technologie. Interesują ich zasady działania i budowa różnych urządzeń.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `doradca`
--

CREATE TABLE `doradca` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `czy_aktywny` tinyint(1) NOT NULL,
  `data_utworzenia` date NOT NULL,
  `czy_admin` tinyint(1) NOT NULL,
  `nazwisko` varchar(40) DEFAULT NULL,
  `imie` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `doradca`
--



-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `doradztwo`
--

CREATE TABLE `doradztwo` (
  `id` int(11) NOT NULL,
  `id_klienta` int(11) NOT NULL,
  `id_doradcy` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `id_status` int(11) NOT NULL,
  `rodzaj_doradztwa` enum('zainteresowan','motywacji','uczenia','osobowosci') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `doradztwo`
--



-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient`
--

CREATE TABLE `klient` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `data_utworzenia` date NOT NULL,
  `imie` varchar(40) DEFAULT NULL,
  `nazwisko` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `klient`
--



-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania`
--

CREATE TABLE `pytania` (
  `id` int(11) NOT NULL,
  `nr_pytania` int(11) NOT NULL,
  `pytania` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `pytania`
--

INSERT INTO `pytania` (`id`, `nr_pytania`, `pytania`) VALUES
(1, 1, 'Czy chciałbyś mieć taką pracę, w której kierujesz, kontrolujesz i planujesz działanie innych pracowników'),
(2, 2, 'Czy bezinteresownie pomagasz innym?'),
(3, 3, 'Czy lubisz pracować nad jednym zadaniem dopóki go nie skończysz?'),
(4, 4, 'Czy lubisz mieć wiele spraw na głowie?'),
(5, 5, 'Czy lubisz konstruować i naprawiać różne rzeczy?'),
(6, 6, 'Czy lubisz brać na siebie odpowiedzialność za zadania i wywiązywać się z nich?'),
(7, 7, 'Czy lubisz pomagać kolegom w rozwiązywaniu problemów?'),
(8, 8, 'Czy wolałbyś taką pracę, gdzie zawsze będziesz miał pewność, czego się od Ciebie oczekuje?'),
(9, 9, 'Czy lubisz książki i programy popularnonaukowe, np. dziedziny astronomii czy biologii?'),
(10, 10, 'Czy potrafisz projektować, wymyślać lub tworzyć różne przedmioty?'),
(11, 11, 'Czy lubisz kierować działaniami innych ludzi?'),
(12, 12, 'Czy jesteś w stanie pomagać ludziom, którzy są zdenerwowani lub zmartwieni?'),
(13, 13, 'Czy projekty lub inne prace wykonujesz dokładnie, krok po kroku?'),
(14, 14, 'Czy lubisz zagłębiać się w problemy, nad którymi pracujesz?'),
(15, 15, 'Czy masz jakieś własne hobby, które Cię pochłania?'),
(16, 16, 'Czy chciałabyś mieć taką pracę, gdzie byłbyś odpowiedzialny za podejmowanie decyzji?'),
(17, 17, 'Czy chciałbyś wykonywać pracę polegającą na pytaniu ludzi o ich opinie w sprawach różnych rzeczy lub wydarzeń?'),
(18, 18, 'Czy chciałbyś opierać się w swojej pracy na wyraźnie określonych zasadach i regułach?'),
(19, 19, 'Czy rozwiązując problemy chciałbyś zawsze opierać się na niepodważalnych faktach?'),
(20, 20, 'Czy lubisz grę w szachy i inne gry wymagające logicznego myślenia?'),
(21, 21, 'Czy pełniłeś kiedykolwiek rolę lidera w jakimś klubie, zespole lub organizacji?'),
(22, 22, 'Czy chciałbyś opiekować się ludźmi, którzy są chorzy albo mają jakieś problemy życiowe?'),
(23, 23, 'Czy lubisz pracować nad jednym zadaniem przez dłuższy czas?'),
(24, 24, 'Czy podobałaby Ci się praca, w której każdy dzień niósłby nowe i różnorodne zadania?'),
(25, 25, 'Czy jest dla Ciebie ważne, aby mieć większe osiągnięcia niż inni?'),
(26, 26, 'Czy jest dla Ciebie ważne, aby mieć większe osiągnięcia niż inni?'),
(27, 27, 'Czy chciałbyś mieć pracę, która jest związana z poprawą warunków socjalnych?'),
(28, 28, 'Czy lubisz pracować według otrzymanych wytycznych?'),
(29, 29, 'Czy chciałbyś wykonywać prace badawcze?'),
(30, 30, 'Czy chciałbyś pracować z materiałami takimi jak: drewno, kamień, glina, tkanina, metal?'),
(31, 31, 'Czy lubisz być odpowiedzialny za projekt, zadanie, które wymaga dopilnowania różnych szczegółów, aby mogło zostać wykonane w całości?'),
(32, 32, 'Czy chciałbyś mieć prace związaną ze służbą dla określonego środowiska?'),
(33, 33, 'Czy chciałbyś mieć taką pracę, gdzie Twoje czynności są na ogół ściśle kontrolowane?'),
(34, 34, 'Czy jesteś w stanie radzić sobie w sytuacji, gdy nieustannie dzieje się coś nowego i niespodziewanego?'),
(35, 35, 'Czy chciałbyś być operatorem jakiegoś urządzenia?'),
(36, 36, 'Czy kiedyś byłeś odpowiedzialny za planowanie działań, które miał realizować ktoś inny?'),
(37, 37, 'Czy chciałbyś mieć stanowisko, które wymaga kontaktu z ludźmi cały dzień?'),
(38, 38, 'Czy podejmujesz się nowego zadania dopiero wtedy gdy skończysz poprzednie?'),
(39, 39, 'Czy lubisz realizować zadania, które pozwalają Ci odkrywać nowe fakty bądź prawidłowości?'),
(40, 40, 'Czy lubisz prace ręczne np. szycie, naprawa samochodu itp.?'),
(41, 41, 'Czy wolisz raczej kierować pracą grupy niż być jej członkiem?'),
(42, 42, 'Czy współpraca z ludźmi przychodzi Ci łatwo?'),
(43, 43, 'Czy chciałbyś mieć stanowisko, które wymaga stałego tempa pracy przez cały dzień?'),
(44, 44, 'Czy lubisz wypróbowywać różne, nawet niesprawdzone metody, aby całkowicie wykonać zadanie lub rozwiązać problem?'),
(45, 45, 'Czy cieszy Cię, kiedy dzięki książkom lub programom telewizyjnym możesz dowiedzieć się jak działają różne urządzenia?'),
(46, 46, 'Czy zwykle udaje Ci się nakłonić ludzi, żeby robili to czego Ty chcesz?'),
(47, 47, 'Czy lubisz doglądać pracy innych ludzi?'),
(48, 48, 'Czy umiesz przyjmować polecenia?'),
(49, 49, 'Czy lubisz takie działania, których wynik daje się obiektywnie zmierzyć?'),
(50, 50, 'Czy raczej wolałbyś pracę nie wymagającą kontaktu z ludźmi?');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania_motywacje`
--

CREATE TABLE `pytania_motywacje` (
  `id` int(11) NOT NULL,
  `tresc` text DEFAULT NULL,
  `nr_pytania` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pytania_motywacje`
--

INSERT INTO `pytania_motywacje` (`id`, `tresc`, `nr_pytania`) VALUES
(1, 'Wiem, w jakim kierunku chcę podnieść kwalifikacje.', 1),
(2, 'Mam dużo energii i zapału do podnoszenia kompetencji i zdobywania nowych umiejętności.', 2),
(3, 'Mam wysoką motywację do udziału w projekcie.', 3),
(4, 'Oceniam wysoko przydatność wybranego szkolenia przy poszukiwaniu  pracy.', 4),
(5, 'Chcę poszerzać swoje umiejętności planowania ścieżki zawodowej.', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania_osobowosc`
--

CREATE TABLE `pytania_osobowosc` (
  `id` int(11) NOT NULL,
  `tresc` text DEFAULT NULL,
  `rodzaj` enum('mocne','slabe') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pytania_osobowosc`
--

INSERT INTO `pytania_osobowosc` (`id`, `tresc`, `rodzaj`) VALUES
(1, 'SZCZERY', 'mocne'),
(2, 'UCZCIWY', 'mocne'),
(3, 'SKROMNY', 'mocne'),
(4, 'TRZEŹWO MYŚLĄCY', 'mocne'),
(5, 'NATURALNY', 'mocne'),
(6, 'PRAKTYCZNY', 'mocne'),
(7, 'GOSPODARNY', 'mocne'),
(8, 'MAŁOMÓWNY', 'mocne'),
(9, 'WYTRWAŁY W DZIAŁANIU', 'mocne'),
(10, 'NIEZWYKŁY', 'mocne'),
(11, 'ANALITYCZNY', 'mocne'),
(12, 'NIEZALEŻNY', 'mocne'),
(13, 'INTELEKTUALISTA', 'mocne'),
(14, 'WNIKLIWY', 'mocne'),
(15, 'SPOSTZREGAWCZY', 'mocne'),
(16, 'PROFESJONALNY', 'mocne'),
(17, 'DOKŁADNY', 'mocne'),
(18, 'KOMPETENTNY', 'mocne'),
(19, 'EMOCJONALNY', 'mocne'),
(20, 'TWÓRCZY', 'mocne'),
(21, 'DYNAMICZNY', 'mocne'),
(22, 'IMPULSYWNY', 'mocne'),
(23, 'WRAŻLIWY', 'mocne'),
(24, 'INTUICYJNY', 'mocne'),
(25, 'OTWARTY', 'mocne'),
(26, 'POMYSŁOWY', 'mocne'),
(27, 'OBDARZONY WYOBRAŹNIĄ', 'mocne'),
(28, 'UPRZEJMY', 'mocne'),
(29, 'PRZEKONYWUJĄCY', 'mocne'),
(30, 'ROZUMIEJĄCY INNYCH LUDZI', 'mocne'),
(31, 'CIERPLIWY', 'mocne'),
(32, 'POPIERAJĄCY', 'mocne'),
(33, 'WSPÓŁCZUJĄCY', 'mocne'),
(34, 'TAKTOWNY', 'mocne'),
(35, 'ODPOWIEDZIALNY', 'mocne'),
(36, 'TOWARZYSKI', 'mocne'),
(37, 'KONSEKWENTNY', 'mocne'),
(38, 'ODWAŻNY', 'mocne'),
(39, 'STANOWCZY', 'mocne'),
(40, 'ENERGICZNY', 'mocne'),
(41, 'CHARYZMATYCZNY', 'mocne'),
(42, 'PEWNY SIEBIE', 'mocne'),
(43, 'POPULARNY', 'mocne'),
(44, 'DBAJĄCY O ZYSK', 'mocne'),
(45, 'PRZYCIĄGAJĄCY UWAGĘ', 'mocne'),
(46, 'DOKŁADNY', 'mocne'),
(47, 'DOSTOSOWUJĄCY SIĘ', 'mocne'),
(48, 'CZUJNY', 'mocne'),
(49, 'SKUTECZNY', 'mocne'),
(50, 'OSTROŻNY', 'mocne'),
(51, 'PEDANTYCZNY', 'mocne'),
(52, 'LOJALNY', 'mocne'),
(53, 'PUNKTUALNY', 'mocne'),
(54, 'STARANNY', 'mocne'),
(55, 'FAŁSZYWY', 'slabe'),
(56, 'NIETAKTOWNY', 'slabe'),
(57, 'PRZEWRAŻLIWIONY', 'slabe'),
(58, 'ROZRZUTNY', 'slabe'),
(59, 'SAMOTNIK', 'slabe'),
(60, 'ROZTARGNIONY', 'slabe'),
(61, 'SKRYTY', 'slabe'),
(62, 'BOJAŹLIWY', 'slabe'),
(63, 'PLOTKUJĄCY', 'slabe'),
(64, 'NIEGOSPODARNY', 'slabe'),
(65, 'OBOJĘTNY', 'slabe'),
(66, 'LIZUS', 'slabe'),
(67, 'NERWOWY', 'slabe'),
(68, 'NIEODPOWIEDZALNY', 'slabe'),
(69, 'MANIPULANT', 'slabe'),
(70, 'LENIWY', 'slabe'),
(71, 'PESYMISTA', 'slabe'),
(72, 'NIESTARANNY', 'slabe'),
(73, 'APATYCZNY', 'slabe'),
(74, 'NIETOLERANCYJNY', 'slabe'),
(75, 'WYBREDNY', 'slabe'),
(76, 'CHAOTYCZNY', 'slabe'),
(77, 'KRYTYKUJĄCY', 'slabe'),
(78, 'DENERWUJĄCY', 'slabe'),
(79, 'BAŁAGANIARZ', 'slabe'),
(80, 'OBOJĘTNY', 'slabe'),
(81, 'WTRĄCAJĄCY', 'slabe'),
(82, 'IMPULSYWNY', 'slabe'),
(83, 'SKONCENTROWANY NA SOBIE', 'slabe'),
(84, 'NIETOWARZYSKI', 'slabe'),
(85, 'NIESPOKOJNY', 'slabe'),
(86, 'NIEUFNY', 'slabe'),
(87, 'OBRAŻAJĄCY SIĘ', 'slabe'),
(88, 'LĘKLIWY', 'slabe'),
(89, 'ZAMKNIĘTY W SOBIE', 'slabe'),
(90, 'ZAKŁAMANY', 'slabe'),
(91, 'PEWNY SIEBIE', 'slabe'),
(92, 'NIEŚMIAŁY', 'slabe'),
(93, 'GŁOŚNY', 'slabe'),
(94, 'RYZYKANT', 'slabe'),
(95, 'SKĄPY', 'slabe'),
(96, 'KŁÓTLIWY', 'slabe'),
(97, 'SPÓŹNIAJĄCY SIĘ', 'slabe'),
(98, 'PRZEBIEGŁY', 'slabe'),
(99, 'GADATLIWY', 'slabe'),
(100, 'NIEZORGANIZOWANY', 'slabe'),
(101, 'MAŁO KREATYWNY', 'slabe'),
(102, 'POZWALAJĄCY NA WSZYSTKO', 'slabe'),
(103, 'NIESKUTECZNY', 'slabe'),
(104, 'MŚCIWY', 'slabe'),
(105, 'APODYKTYCZNY', 'slabe'),
(106, 'KAPRYŚNY', 'slabe'),
(107, 'NIEKOMPETENTNY', 'slabe'),
(108, 'NIEOSTROŻNY', 'slabe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania_style`
--

CREATE TABLE `pytania_style` (
  `id` int(11) NOT NULL,
  `nr_pytania` int(11) DEFAULT NULL,
  `tresc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pytania_style`
--

INSERT INTO `pytania_style` (`id`, `nr_pytania`, `tresc`) VALUES
(1, 1, 'Kiedy pierwszy raz posługuję się nowym dla mnie sprzętem…'),
(2, 1, 'Czytam instrukcję'),
(3, 1, 'Słucham, ewentualnie dopytuję'),
(4, 1, 'Uczę się obsługi na zasadzie prób i błędów'),
(5, 2, 'Kiedy zgubiłem/am drogę…'),
(6, 2, 'Patrzę na mapę'),
(7, 2, 'Pytam ludzi o wskazówki'),
(8, 2, 'Idę „na czuja”, ewentualnie używam kompasu'),
(9, 3, 'Kiedy gotuję nową potrawę…'),
(10, 3, 'Podążam za instrukcjami w przepisie'),
(11, 3, 'Dzwonię do znajomego i proszę wytłumaczenie'),
(12, 3, 'Gotując, próbuję'),
(13, 4, 'By kogoś czegoś nauczyć…'),
(14, 4, 'Piszę instrukcje'),
(15, 4, 'Tłumaczę'),
(16, 4, 'Demonstruję i daję szansę na spróbowanie'),
(17, 5, 'Mówię zazwyczaj...'),
(18, 5, 'Widzę, o co Ci chodzi'),
(19, 5, 'Z tego, co słyszę…'),
(20, 5, 'Wiem, co czujesz'),
(21, 6, 'Zazwyczaj mówię…'),
(22, 6, 'Pokaż mi'),
(23, 6, 'Powiedz mi'),
(24, 6, 'Daj mi spróbować'),
(25, 7, 'Zazwyczaj mówię...'),
(26, 7, 'Zobacz jak to się robi'),
(27, 7, 'Wytłumaczę Ci'),
(28, 7, 'Spróbuj'),
(29, 8, 'Jak chcę się poskarżyć na wadliwy towar'),
(30, 8, 'Sporządzam pismo'),
(31, 8, 'Dzwonię'),
(32, 8, 'Wracam do sklepu, albo odsyłam wadliwy produkt do dyrektora'),
(33, 9, 'W czasie wolnym wolę'),
(34, 9, 'Muzea lub galerie'),
(35, 9, 'Muzykę lub rozmowy'),
(36, 9, 'Aktywność fizyczną'),
(37, 10, 'Kiedy idę na zakupy zazwyczaj…'),
(38, 10, 'Oglądam i wtedy decyduję'),
(39, 10, 'Pytam o radę obsługę'),
(40, 10, 'Próbuję, przymierzam'),
(41, 11, 'Wybierając wakacje'),
(42, 11, 'Czytam broszurki'),
(43, 11, 'Radzę się znajomych'),
(44, 11, 'Staram się wyobrazić sobie, jak to będzie'),
(45, 12, 'Wybierając nowy samochód'),
(46, 12, 'Czytam opinie'),
(47, 12, 'Rozmawiam ze znajomymi'),
(48, 12, 'Decyduję się na jazdę próbną samochodem, który mi się podoba'),
(49, 13, 'Ucząc się czegoś nowego'),
(50, 13, 'Patrzę, jak to robi nauczyciel, wykładowca, trener'),
(51, 13, 'Omawiam wszystko dokładnie krok po kroku'),
(52, 13, 'Próbuję sam/a to rozpracować'),
(53, 14, 'Wybierając z menu w restauracji...'),
(54, 14, 'Wyobrażam sobie, jak danie będzie wyglądało'),
(55, 14, 'Rozważam „różne pozycje w mojej głowie”'),
(56, 14, 'Zastanawiam się, jak to będzie smakowało'),
(57, 15, 'Słuchając muzyki…'),
(58, 15, 'Wyśpiewuję tekst w głowie lub na głos'),
(59, 15, 'Słucham tekstu i melodii'),
(60, 15, 'Wyobrażam sobie to, o czym śpiewają'),
(61, 16, 'Najlepiej zapamiętuję…'),
(62, 16, 'Robiąc notatki i przeglądając kartki'),
(63, 16, 'Czytając na głos powtarzając sobie w głowie najważniejsze punkty'),
(64, 16, 'Wyobrażając sobie treści, których się uczę i testując nową wiedzę w działaniu'),
(65, 17, 'Moje pierwsze wspomnienie dotyczy…'),
(66, 17, 'Widoku czegoś'),
(67, 17, 'Czyjegoś głosu'),
(68, 17, 'Robienia czegoś'),
(69, 18, 'Kiedy czegoś się obawiam...'),
(70, 18, 'Wyobrażam sobie najgorsze scenariusze'),
(71, 18, 'Omawiam problem w głowie'),
(72, 18, 'Nie mogę usiedzieć w miejscu, kręcę się to tu, to tam'),
(73, 19, 'Czuję się blisko z ludźmi, ze względu na to…'),
(74, 19, 'Jak wyglądają'),
(75, 19, 'Co do mnie mówią'),
(76, 19, 'Jak się przy nich czuję'),
(77, 20, 'Kiedy powtarzam materiał na egzamin…'),
(78, 20, 'Robię mnóstwo notatek, używając różnych kolorów'),
(79, 20, 'Czytam notatki, sobie lub znajomym'),
(80, 20, 'Wyobrażam sobie, jak piszę różne sformułowania, wzory'),
(81, 21, 'Kiedy komuś coś tłumaczę…'),
(82, 21, 'Pokazuję, o co mi chodzi'),
(83, 21, 'Opowiadam na różne sposoby, aż druga osoba zrozumie'),
(84, 21, 'Zachęcam, by ktoś zaczął to robić i w międzyczasie omawiam trudności'),
(85, 22, 'Moje główne zainteresowania to'),
(86, 22, 'Fotografia, oglądanie filmów'),
(87, 22, 'Słuchanie muzyki, radia, rozmowy ze znajomymi'),
(88, 22, 'Aktywność fizyczna, dobre wino, jedzenie, taniec, uprawiając sport'),
(89, 23, 'Większość wolnego czasu spędzam'),
(90, 23, 'Oglądając telewizję'),
(91, 23, 'Rozmawiając ze znajomymi'),
(92, 23, 'Na aktywności fizycznej, na pracach manualnych'),
(93, 24, 'Przy pierwszym kontakcie z jakąś osobą…'),
(94, 24, 'Organizuję spotkanie twarzą w twarz'),
(95, 24, 'Rozmawiam z nią przez telefon'),
(96, 24, 'Staram się coś wspólnie zrobić czy załatwić'),
(97, 25, 'Przy pierwszym kontakcie spostrzegam …'),
(98, 25, 'Jak osoba wygląda i jak jest ubrana'),
(99, 25, 'Jaki ktoś ma głos i jak mówi'),
(100, 25, 'Jaką osoba ma postawę i jak się porusza'),
(101, 26, 'Kiedy jestem bardzo zdenerwowany/a, to…'),
(102, 26, 'Odtwarzam sobie w głowie to, co mnie zdenerwowało'),
(103, 26, 'Wykrzykuję i mówię ludziom, co czuję'),
(104, 26, 'Tupię, trzaskam drzwiami, rzucam rzeczami'),
(105, 27, 'Najłatwiej zapamiętuję…'),
(106, 27, 'Twarze'),
(107, 27, 'Imiona'),
(108, 27, 'Rzeczy, które robiłem/am'),
(109, 28, 'Podejrzewam, że ktoś kłamie, gdy...'),
(110, 28, 'Widzę, że unika wzroku'),
(111, 28, 'Słyszę zmianę w tonie głosu'),
(112, 28, 'Czuję to'),
(113, 29, 'Kiedy widzę się ze starym przyjacielem'),
(114, 29, 'Mówię: “Jak dobrze Cię widzieć”'),
(115, 29, '“Jak dobrze wreszcie usłyszeć Twój głos”'),
(116, 29, 'Ściskam go lub podaję rękę');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `nazwa`) VALUES
(1, 'Nowy'),
(2, 'Zakonczony_kwestionariusz_zainteresowan'),
(3, 'Zakończony_kwestionariusz_motywacji'),
(4, 'zakonczony_kwestionariusz_stylow'),
(5, 'zakonczony_kwestionariusz_osobowosci');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `style_uczenia`
--

CREATE TABLE `style_uczenia` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(40) DEFAULT NULL,
  `tresc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `style_uczenia`
--

INSERT INTO `style_uczenia` (`id`, `nazwa`, `tresc`) VALUES
(1, 'Wzrokowiec', 'Uczy się korzystając z kolorowych plansz, wykresów. Myśląc ma tendencję do spoglądania w górę, słuchając potrzebuje kontaktu wzrokowego z mówcą. Ma dobrą pamięć do wizualnych elementów (do materiału wydrukowanego, narysowanego). Ucząc się siedzi dość spokojnie, zazwyczaj szybko mówi. Komunikaty werbalne zamienia na obraz. Uczy się szybko jeżeli informacje są uporządkowane. Gdy mówi jest dobrze widoczny. Zwraca uwagę na kolor, kształt, ładny wygląd stroju, mieszkania, książki..\r\n \r\nPodczas nauki pamiętaj...\r\nstwórz materiał graficzny tego co się uczysz\r\nsporządzaj mapy myśli\r\nwyobrażaj sobie dany problem i sposób jego rozwiązania\r\nrób notatki, używaj cienkopisów, mazaków, zakreślaczy\r\nPodczas nauki języków obcych pamiętaj...\r\nsporządzaj rysunki – znaczenia danych słówek\r\nsporządzaj mapy myśli\r\nzapisuj nowo poznane słowa\r\nsporządzaj karteczki, notatki, z nieznanymi słowami, naklejaj je na miejsca na które często patrzysz\r\nwyobrażaj sobie to słowo i jego znaczenie\r\nomawiaj scenki i rysunki, wyobrażaj sobie siebie mówiącego w obcym języku\r\n'),
(2, 'Słuchowiec', 'Uczy się zazwyczaj słuchając, mówiąc na głos. Potrzebuje ciągłych bodźców słuchowych, ale podczas nauki preferuje ciszę, bodźce słuchowe mogą nadmiernie koncentrować jego uwagę. Gdy mówi jest dobrze słyszany. Nie potrzebuje kontaktu wzrokowego z rozmówcą. Ma dobrą pamięć do dialogów, muzyki, dźwięków...\r\n\r\nPodczas nauki pamiętaj...\r\ntwórz mapy myśli i na głos omawiaj jej elementy\r\nczytaj tekst na głos\r\ndyskutuj z kimś o danym problemie, wytłumacz go i pozwól sobie go wytłumaczyć\r\nucz się w ciszy, muzyka czy inne hałasy mogą nadmiernie koncentrować Twoją uwagę\r\n\r\nPodczas nauki języków obcych pamiętaj...\r\nstaraj się dużo mówić w obcym języku, stwarzaj obcojęzyczną atmosferę, \r\nwypowiadaj na głos nieznane słowa, zwracając uwagę na ich wymowę\r\nnagrywaj nieznane słówka/zwroty i odtwarzaj je\r\noglądaj obcojęzyczne filmy, słuchaj obcojęzycznej stacji radiowej, śpiewaj obcojęzyczne piosenki\r\n'),
(3, 'Ruchowiec/Czuciowiec', 'Podczas nauki swobodnie rozsiada się, bawiąc się długopisem czy innym przedmiotem. Jest zaangażowany w aktywność ruchową, uczy się gdy ciało jest w ruchu. Gdy coś się dzieje ciekawego w otoczeniu wodzi za tym wzrokiem. Ma dobrą pamięć do działań i ruchów ciała. Patrząc na innych odczytuje ich mowę ciała. Lubi pracować w środowisku przyjaznym fizycznie i emocjonalnie.\r\nPodczas nauki pamiętaj...\r\nsporządzaj plan pracy, odgrywaj scenki, twórz wizualizację tego co się uczysz\r\njak się uczysz spaceruj, idź do parku\r\n\r\nPodczas nauki języków obcych pamiętaj...\r\nodgrywaj scenki w obcym języku\r\nczytaj nieznane słówka będąc w ruchu\r\nbierz do ręki przedmioty, których znaczenie w obcym języku chcesz zapamiętać\r\ngestykuluj podczas mówienia w obcym języku\r\n');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wynik`
--

CREATE TABLE `wynik` (
  `id` int(11) NOT NULL,
  `id_doradztwa` int(11) NOT NULL,
  `id_cechy` int(11) NOT NULL,
  `punkty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wynik_motywacje`
--

CREATE TABLE `wynik_motywacje` (
  `id` int(11) NOT NULL,
  `id_doradztwa` int(11) DEFAULT NULL,
  `punkty` int(11) DEFAULT NULL,
  `id_pytania` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wynik_osobowosc`
--

CREATE TABLE `wynik_osobowosc` (
  `id` int(11) NOT NULL,
  `id_doradztwa` int(11) DEFAULT NULL,
  `mocne_strony` text DEFAULT NULL,
  `slabe_strony` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wynik_style_uczenia`
--

CREATE TABLE `wynik_style_uczenia` (
  `id` int(11) NOT NULL,
  `id_doradztwa` int(11) DEFAULT NULL,
  `id_stylu` int(11) DEFAULT NULL,
  `punkty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cecha`
--
ALTER TABLE `cecha`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `doradca`
--
ALTER TABLE `doradca`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `doradztwo`
--
ALTER TABLE `doradztwo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doradztwo_id_doradcy_foreign` (`id_doradcy`),
  ADD KEY `doradztwo_id_klienta_foreign` (`id_klienta`),
  ADD KEY `doradztwo_id_status_foreign` (`id_status`);

--
-- Indeksy dla tabeli `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pytania`
--
ALTER TABLE `pytania`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pytania_motywacje`
--
ALTER TABLE `pytania_motywacje`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pytania_osobowosc`
--
ALTER TABLE `pytania_osobowosc`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pytania_style`
--
ALTER TABLE `pytania_style`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `style_uczenia`
--
ALTER TABLE `style_uczenia`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wynik`
--
ALTER TABLE `wynik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wynik_id_cechy_foreign` (`id_cechy`),
  ADD KEY `wynik_id_doradztwa_foreign` (`id_doradztwa`);

--
-- Indeksy dla tabeli `wynik_motywacje`
--
ALTER TABLE `wynik_motywacje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doradztwa` (`id_doradztwa`),
  ADD KEY `id_pytania` (`id_pytania`);

--
-- Indeksy dla tabeli `wynik_osobowosc`
--
ALTER TABLE `wynik_osobowosc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doradztwa` (`id_doradztwa`);

--
-- Indeksy dla tabeli `wynik_style_uczenia`
--
ALTER TABLE `wynik_style_uczenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doradztwa` (`id_doradztwa`),
  ADD KEY `id_stylu` (`id_stylu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cecha`
--
ALTER TABLE `cecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doradca`
--
ALTER TABLE `doradca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doradztwo`
--
ALTER TABLE `doradztwo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `klient`
--
ALTER TABLE `klient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pytania`
--
ALTER TABLE `pytania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `pytania_motywacje`
--
ALTER TABLE `pytania_motywacje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pytania_osobowosc`
--
ALTER TABLE `pytania_osobowosc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `pytania_style`
--
ALTER TABLE `pytania_style`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `style_uczenia`
--
ALTER TABLE `style_uczenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wynik`
--
ALTER TABLE `wynik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `wynik_motywacje`
--
ALTER TABLE `wynik_motywacje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wynik_osobowosc`
--
ALTER TABLE `wynik_osobowosc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wynik_style_uczenia`
--
ALTER TABLE `wynik_style_uczenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doradztwo`
--
ALTER TABLE `doradztwo`
  ADD CONSTRAINT `doradztwo_id_doradcy_foreign` FOREIGN KEY (`id_doradcy`) REFERENCES `doradca` (`id`),
  ADD CONSTRAINT `doradztwo_id_klienta_foreign` FOREIGN KEY (`id_klienta`) REFERENCES `klient` (`id`),
  ADD CONSTRAINT `doradztwo_id_status_foreign` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`);

--
-- Constraints for table `wynik`
--
ALTER TABLE `wynik`
  ADD CONSTRAINT `wynik_id_cechy_foreign` FOREIGN KEY (`id_cechy`) REFERENCES `cecha` (`id`),
  ADD CONSTRAINT `wynik_id_doradztwa_foreign` FOREIGN KEY (`id_doradztwa`) REFERENCES `doradztwo` (`id`);

--
-- Constraints for table `wynik_motywacje`
--
ALTER TABLE `wynik_motywacje`
  ADD CONSTRAINT `wynik_motywacje_ibfk_1` FOREIGN KEY (`id_doradztwa`) REFERENCES `doradztwo` (`id`),
  ADD CONSTRAINT `wynik_motywacje_ibfk_2` FOREIGN KEY (`id_pytania`) REFERENCES `pytania_motywacje` (`id`);

--
-- Constraints for table `wynik_osobowosc`
--
ALTER TABLE `wynik_osobowosc`
  ADD CONSTRAINT `wynik_osobowosc_ibfk_1` FOREIGN KEY (`id_doradztwa`) REFERENCES `doradztwo` (`id`);

--
-- Constraints for table `wynik_style_uczenia`
--
ALTER TABLE `wynik_style_uczenia`
  ADD CONSTRAINT `wynik_style_uczenia_ibfk_1` FOREIGN KEY (`id_doradztwa`) REFERENCES `doradztwo` (`id`),
  ADD CONSTRAINT `wynik_style_uczenia_ibfk_2` FOREIGN KEY (`id_stylu`) REFERENCES `style_uczenia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
