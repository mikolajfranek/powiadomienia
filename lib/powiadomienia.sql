SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Baza danych: `powiadomienia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `id_game` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `address` text NOT NULL,
  `content` text NOT NULL,
  `lottery_date` date NOT NULL,
  `sent` datetime DEFAULT NULL,
  `delivered` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `id_game` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `lottery_date` date NOT NULL,
  `lottery_numbers` text NOT NULL,
  `collection` text NOT NULL,
  `winning_numbers` text NOT NULL,
  `winning_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `id_game` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_begin` date NOT NULL,
  `date_end` date NOT NULL,
  `numbers` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `is_account_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_account_active` tinyint(1) NOT NULL DEFAULT 0,
  `is_email_confirmation` tinyint(1) NOT NULL DEFAULT 0,
  `is_email_notification` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;