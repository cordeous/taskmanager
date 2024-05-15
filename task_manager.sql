SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `tbl_lists` (
  `list_id` int(10) UNSIGNED NOT NULL,
  `list_name` varchar(50) NOT NULL,
  `list_description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_lists` (`list_id`, `list_name`, `list_description`) VALUES
(1, 'To-Do', 'Enter tasks to be done here'),
(2, 'Doing', ''),
(3, 'Done', '');

CREATE TABLE `tbl_tasks` (
  `task_id` int(10) UNSIGNED NOT NULL,
  `task_name` varchar(150) NOT NULL,
  `task_description` text NOT NULL,
  `list_id` int(11) NOT NULL,
  `priority` varchar(10) NOT NULL,
  `deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_tasks` (`task_id`, `task_name`, `task_description`, `list_id`, `priority`, `deadline`) VALUES
(1, 'Research', 'Conduct research for upcoming project', 1, 'High', '2022-06-15'),
(2, 'Proposal Writing', 'Write proposal for client presentation', 3, 'Medium', '2022-06-18'),
(3, 'Data Analysis', '', 2, 'High', '2022-06-17'),
(4, 'Front-End Development', '', 1, 'Medium', '2022-06-30'),
(5, 'Back-End Development', '', 2, 'Low', '2022-07-05'),
(6, 'Integration Testing', '', 1, 'Medium', '2022-07-10'),
(7, 'Client Meeting', '', 1, 'Medium', '2022-07-15');


ALTER TABLE `tbl_lists`
  ADD PRIMARY KEY (`list_id`);

ALTER TABLE `tbl_tasks`
  ADD PRIMARY KEY (`task_id`);

ALTER TABLE `tbl_lists`
  MODIFY `list_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `tbl_tasks`
  MODIFY `task_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

COMMIT;
