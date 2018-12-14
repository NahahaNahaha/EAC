-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1

-- Generation Time: Jun 18, 2018 at 10:14 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cluster`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_alarms`
--

CREATE TABLE `active_alarms` (
  `id` int(11) NOT NULL,
  `alarm_id` int(11) NOT NULL,
  `node_group_id` bigint(11) NOT NULL DEFAULT '0',
  `region` varchar(64) NOT NULL DEFAULT 'default' COMMENT 'for regional alarm evaluation',
  `last_active` bigint(11) NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL DEFAULT '0',
  `state_updated` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `alarms`
--

CREATE TABLE `alarms` (
  `id` int(20) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `alarm_conditions_id` int(11) NOT NULL DEFAULT '1',
  `trigger_type` int(11) NOT NULL DEFAULT '0',
  `target_type` bigint(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alarms`
--

INSERT INTO `alarms` (`id`, `type`, `alarm_conditions_id`, `trigger_type`, `target_type`) VALUES
(1, 0, 1, 3, 1),
(2, 0, 3, 1, 2),
(3, 1, 4, 0, 2),
(4, 0, 5, 11, 3),
(5, 1, 6, 12, 3),
(6, 1, 2, 2, 1),
(7, 0, 7, 15, 4),
(8, 1, 8, 16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `alarm_conditions`
--

CREATE TABLE `alarm_conditions` (
  `id` int(11) NOT NULL,
  `metric` int(11) NOT NULL DEFAULT '3',
  `unit` int(11) NOT NULL DEFAULT '0',
  `threshold` double NOT NULL DEFAULT '0',
  `comparator` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alarm_conditions`
--

INSERT INTO `alarm_conditions` (`id`, `metric`, `unit`, `threshold`, `comparator`) VALUES
(1, 3, 0, 60, 2),
(2, 3, 0, 0, 0),
(3, 3, 0, 60, 2),
(4, 3, 0, 0, 0),
(5, 3, 0, 60, 2),
(6, 3, 0, 0, 0),
(7, 3, 0, 60, 2),
(8, 3, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `alarm_target`
--

CREATE TABLE `alarm_target` (
  `id` bigint(20) NOT NULL,
  `target_type` int(2) NOT NULL DEFAULT '1' COMMENT 'node or nodegroup',
  `target_sub_type` int(2) NOT NULL DEFAULT '0' COMMENT 'Node type / NodeGroup type (enum)',
  `aux_data` text COMMENT 'Additional data dump'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alarm_target`
--

INSERT INTO `alarm_target` (`id`, `target_type`, `target_sub_type`, `aux_data`) VALUES
(1, 1, 3, NULL),
(2, 1, 2, NULL),
(3, 1, 4, NULL),
(4, 1, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `autoscalelog`
--

CREATE TABLE `autoscalelog` (
  `id` bigint(20) NOT NULL,
  `group_id` bigint(20) NOT NULL,
  `alarm_trigger_type` int(11) DEFAULT '1',
  `scale_policy` varchar(64) DEFAULT NULL,
  `timestamp` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cluster_link`
--

CREATE TABLE `cluster_link` (
  `link_id` bigint(20) NOT NULL,
  `relation_id` bigint(20) NOT NULL,
  `state` int(11) NOT NULL,
  `state_updated` bigint(20) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cluster_relations`
--

CREATE TABLE `cluster_relations` (
  `id` bigint(20) NOT NULL,
  `child_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_id` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crons`
--

CREATE TABLE `crons` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `host` varchar(100) DEFAULT NULL,
  `start_time` bigint(20) NOT NULL DEFAULT '0',
  `end_time` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group_statistics`
--

CREATE TABLE `group_statistics` (
  `id` bigint(20) NOT NULL,
  `group_id` bigint(20) NOT NULL,
  `target_type` int(11) NOT NULL,
  `net_capacity_count` bigint(20) NOT NULL,
  `net_load_count` bigint(20) NOT NULL,
  `created` bigint(20) NOT NULL DEFAULT '0',
  `updated` bigint(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `launch_configs`
--

CREATE TABLE `launch_configs` (
  `id` bigint(20) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `data` text NOT NULL,
  `updated` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loc_geozones`
--

CREATE TABLE `loc_geozones` (
  `id` bigint(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Geozone info';

-- --------------------------------------------------------

--
-- Table structure for table `loc_regions`
--

CREATE TABLE `loc_regions` (
  `id` bigint(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `code` varchar(20) NOT NULL,
  `geozone_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='region info';

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `host` varchar(50) NOT NULL,
  `last_ping` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `node`
--

CREATE TABLE `node` (
  `id` bigint(20) NOT NULL,
  `host` varchar(150) NOT NULL,
  `hostname` varchar(150) DEFAULT NULL,
  `state` int(11) DEFAULT '0',
  `type` int(11) DEFAULT '0',
  `name` varchar(150) DEFAULT NULL,
  `node_platform_id` varchar(150) DEFAULT NULL,
  `region` varchar(64) DEFAULT NULL COMMENT 'mico location',
  `geozone` varchar(64) NOT NULL DEFAULT 'global' COMMENT 'macro location',
  `launchTime` bigint(20) NOT NULL DEFAULT '0',
  `group_id` bigint(20) NOT NULL,
  `created` bigint(20) NOT NULL DEFAULT '-1',
  `updated` bigint(20) NOT NULL DEFAULT '-1',
  `state_updated` bigint(20) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `node_group`
--

CREATE TABLE `node_group` (
  `id` bigint(20) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `originConnections` int(8) NOT NULL,
  `regions` text,
  `launch_config` varchar(64) NOT NULL,
  `scale_policy` varchar(64) NOT NULL,
  `meta` text,
  `type` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '0',
  `created` bigint(20) NOT NULL DEFAULT '-1',
  `updated` bigint(20) NOT NULL DEFAULT '-1',
  `state_updated` bigint(20) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `node_info`
--

CREATE TABLE `node_info` (
  `info_id` bigint(20) NOT NULL,
  `node_id` bigint(20) DEFAULT NULL,
  `client_count` int(11) DEFAULT '0',
  `publisher_count` int(11) NOT NULL DEFAULT '0',
  `origins` text,
  `edges` text,
  `connection_capacity` int(11) DEFAULT NULL,
  `extended_client_count` int(11) NOT NULL DEFAULT '0' COMMENT 'origin specific',
  `processors` int(11) NOT NULL DEFAULT '0',
  `freememory` bigint(20) NOT NULL DEFAULT '0',
  `maxmemory` bigint(20) NOT NULL DEFAULT '0',
  `totalmemory` bigint(20) NOT NULL DEFAULT '0',
  `committedvirtualmemorysize` bigint(20) NOT NULL DEFAULT '0',
  `totalswapspacesize` bigint(20) NOT NULL DEFAULT '0',
  `freeswapspacesize` bigint(20) NOT NULL DEFAULT '0',
  `freephysicalmemorysize` bigint(20) NOT NULL DEFAULT '0',
  `openfiledescriptorcount` bigint(20) NOT NULL DEFAULT '0',
  `maxFileDescriptorCount` bigint(20) NOT NULL DEFAULT '0',
  `systemcpuload` decimal(10,0) NOT NULL DEFAULT '0',
  `processcpuload` decimal(10,0) NOT NULL DEFAULT '0',
  `last_traffic_time` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Node dirty flag',
  `last_ping` bigint(20) NOT NULL DEFAULT '0',
  `restreamer_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `node_meta`
--

CREATE TABLE `node_meta` (
  `id` bigint(20) NOT NULL,
  `node_id` bigint(20) NOT NULL,
  `meta_id` bigint(20) NOT NULL,
  `updated` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scale_policies`
--

CREATE TABLE `scale_policies` (
  `id` bigint(20) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `data` text NOT NULL,
  `updated` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `short_term_stream_info`
--

CREATE TABLE `short_term_stream_info` (
  `id` bigint(20) NOT NULL,
  `name` varchar(64) NOT NULL,
  `scope` varchar(64) NOT NULL,
  `start_time` bigint(20) NOT NULL COMMENT 'UTC',
  `end_time` bigint(20) NOT NULL COMMENT 'UTC',
  `duration` bigint(20) NOT NULL DEFAULT '0' COMMENT 'session duration',
  `current_subscribers` bigint(20) NOT NULL DEFAULT '0' COMMENT 'last known active subscribers',
  `max_subscribers` bigint(20) NOT NULL DEFAULT '0' COMMENT 'peak subscribers',
  `lost_subscribers` int(11) NOT NULL DEFAULT '0',
  `total_subscribers` bigint(20) NOT NULL DEFAULT '0' COMMENT 'approx total subscribers',
  `updated` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='short term stream info';

-- --------------------------------------------------------

--
-- Table structure for table `stream_info`
--

CREATE TABLE `stream_info` (
  `id` bigint(20) NOT NULL,
  `node_id` bigint(20) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `description` text,
  `scope` varchar(64) DEFAULT NULL,
  `current_subscribers` int(11) DEFAULT '0',
  `max_subscribers` int(11) NOT NULL DEFAULT '0' COMMENT 'peak subscribers',
  `lost_subscribers` int(11) NOT NULL DEFAULT '0' COMMENT 'approx total subscribers',
  `start_time` bigint(20) NOT NULL DEFAULT '0',
  `updated` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stream_meta`
--

CREATE TABLE `stream_meta` (
  `id` bigint(20) NOT NULL,
  `name` varchar(64) NOT NULL,
  `scope` varchar(64) NOT NULL,
  `meta` text,
  `updated` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vod_stream_info`
--

CREATE TABLE `vod_stream_info` (
  `id` bigint(20) NOT NULL,
  `node_id` bigint(20) NOT NULL,
  `name` varchar(64) NOT NULL,
  `extension` varchar(5) NOT NULL,
  `scope` varchar(64) NOT NULL,
  `current_subscribers` int(11) NOT NULL,
  `last_update` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_event`
--

CREATE TABLE `schedule_event` (
  `id` bigint(20) NOT NULL,
  `event_name` VARCHAR(64) NOT NULL,
  `node_group` VARCHAR(64),
  `date` bigint(20) NOT NULL,
  `quartz_job` VARCHAR(64) NOT NULL,
  `scale_info` VARCHAR(255) NOT NULL ,
  `state` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subscribe_config`
--

CREATE TABLE `subscribe_config` (
  `id` enum('1') NOT NULL,
  `url_construct` varchar(255) NOT NULL,
  `timeout` int(11) NOT NULL DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `publish_config`
--

CREATE TABLE `publish_config` (
  `id` enum('1') NOT NULL,
  `protocol` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `validate_point` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `cors_config`
--

CREATE TABLE `cors_config` (
  `id` bigint(20) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `config` varchar(255) NOT NULL,
  `role` varchar(255) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `cors_config` (`id`, `group_name`, `config`) VALUES 
(1, 'default', 'cors.tagRequests=false;cors.maxAge=3600;cors.exposedHeaders=*;cors.supportsCredentials=true;cors.supportedHeaders=;cors.allowSubdomains=true;cors.supportedMethods=GET, HEAD;cors.allowOrigin=*');




--
-- Indexes for dumped tables
--


--
-- Indexes for table `active_alarms`
--
ALTER TABLE `active_alarms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alarm_id` (`alarm_id`),
  ADD KEY `node_group_id` (`node_group_id`);

--
-- Indexes for table `alarms`
--
ALTER TABLE `alarms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alarm_conditions_id` (`alarm_conditions_id`),
  ADD KEY `target_type` (`target_type`);

--
-- Indexes for table `alarm_conditions`
--
ALTER TABLE `alarm_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alarm_target`
--
ALTER TABLE `alarm_target`
  ADD PRIMARY KEY (`id`),
  ADD KEY `target_type` (`target_type`);

--
-- Indexes for table `autoscalelog`
--
ALTER TABLE `autoscalelog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id_index` (`group_id`);

--
-- Indexes for table `cluster_link`
--
ALTER TABLE `cluster_link`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `relation_id` (`relation_id`);

--
-- Indexes for table `cluster_relations`
--
ALTER TABLE `cluster_relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_id` (`child_id`),
  ADD KEY `parent` (`parent_id`);

--
-- Indexes for table `crons`
--
ALTER TABLE `crons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_statistics`
--
ALTER TABLE `group_statistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `launch_configs`
--
ALTER TABLE `launch_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `launch_config_name` (`name`);

--
-- Indexes for table `loc_geozones`
--
ALTER TABLE `loc_geozones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `geozone` (`name`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `loc_regions`
--
ALTER TABLE `loc_regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `region` (`name`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `geozone_id` (`geozone_id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `host` (`host`);

--
-- Indexes for table `node`
--
ALTER TABLE `node`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `host_UNIQUE` (`host`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `group_id_INDEX` (`group_id`);

--
-- Indexes for table `node_group`
--
ALTER TABLE `node_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `scale_policy` (`scale_policy`),
  ADD KEY `launch_config` (`launch_config`);

--
-- Indexes for table `node_info`
--
ALTER TABLE `node_info`
  ADD PRIMARY KEY (`info_id`),
  ADD UNIQUE KEY `node_id_UNIQUE` (`node_id`),
  ADD KEY `node_id` (`node_id`);

--
-- Indexes for table `node_meta`
--
ALTER TABLE `node_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `node_id` (`node_id`),
  ADD KEY `meta_id` (`meta_id`);

--
-- Indexes for table `scale_policies`
--
ALTER TABLE `scale_policies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `scale_policy_name` (`name`);

--
-- Indexes for table `short_term_stream_info`
--
ALTER TABLE `short_term_stream_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_2` (`name`,`scope`,`start_time`),
  ADD KEY `name` (`name`,`scope`),
  ADD KEY `name_3` (`name`,`scope`);

--
-- Indexes for table `stream_info`
--
ALTER TABLE `stream_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `node_id_2` (`node_id`,`name`,`scope`),
  ADD KEY `node_id` (`node_id`),
  ADD KEY `node_id_3` (`node_id`,`name`,`scope`);

--
-- Indexes for table `stream_meta`
--
ALTER TABLE `stream_meta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `scope_name` (`name`,`scope`);

--
-- Indexes for table `vod_stream_info`
--
ALTER TABLE `vod_stream_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `node_id_2` (`node_id`,`name`,`extension`,`scope`),
  ADD KEY `scope` (`scope`),
  ADD KEY `type` (`extension`),
  ADD KEY `name` (`name`),
  ADD KEY `node_id` (`node_id`);

 --
-- Indexes for table `schedule_event`
-- 
ALTER TABLE `schedule_event`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_name` (`event_name`),
  ADD KEY `node_group` (`node_group`);  
  
--
-- Indexes for table `subscribe_config`
--
ALTER TABLE `subscribe_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url_construct` (`url_construct`);
  
--
-- Indexes for table `publish_config`
--
ALTER TABLE `publish_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `protocol` (`protocol`),
  ADD KEY `host` (`host`),
  ADD KEY `port` (`port`),
  ADD KEY `token` (`token`),
  ADD KEY `validate_point` (`validate_point`);

--
-- Indexes for table `cors_config`
--
ALTER TABLE `cors_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_name` (`group_name`);
  
--
-- AUTO_INCREMENT for dumped tables
--

  
--
-- AUTO_INCREMENT for table `active_alarms`
--
ALTER TABLE `active_alarms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `alarms`
--
ALTER TABLE `alarms`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `alarm_conditions`
--
ALTER TABLE `alarm_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `alarm_target`
--
ALTER TABLE `alarm_target`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `autoscalelog`
--
ALTER TABLE `autoscalelog`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cluster_link`
--
ALTER TABLE `cluster_link`
  MODIFY `link_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cluster_relations`
--
ALTER TABLE `cluster_relations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `crons`
--
ALTER TABLE `crons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `group_statistics`
--
ALTER TABLE `group_statistics`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `launch_configs`
--
ALTER TABLE `launch_configs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loc_geozones`
--
ALTER TABLE `loc_geozones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loc_regions`
--
ALTER TABLE `loc_regions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `node`
--
ALTER TABLE `node`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `node_group`
--
ALTER TABLE `node_group`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `node_info`
--
ALTER TABLE `node_info`
  MODIFY `info_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `node_meta`
--
ALTER TABLE `node_meta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scale_policies`
--
ALTER TABLE `scale_policies`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `short_term_stream_info`
--
ALTER TABLE `short_term_stream_info`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stream_info`
--
ALTER TABLE `stream_info`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stream_meta`
--
ALTER TABLE `stream_meta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vod_stream_info`
--
ALTER TABLE `vod_stream_info`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
  
--
-- AUTO_INCREMENT for table `schedule_event`
--
ALTER TABLE `schedule_event`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
  
--
-- AUTO_INCREMENT for table `cors_config`
--
ALTER TABLE `cors_config`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `active_alarms`
--
ALTER TABLE `active_alarms`
  ADD CONSTRAINT `active_alarms_ibfk_1` FOREIGN KEY (`alarm_id`) REFERENCES `alarms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `active_alarms_ibfk_2` FOREIGN KEY (`node_group_id`) REFERENCES `node_group` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `alarms`
--
ALTER TABLE `alarms`
  ADD CONSTRAINT `alarms_ibfk_1` FOREIGN KEY (`alarm_conditions_id`) REFERENCES `alarm_conditions` (`id`),
  ADD CONSTRAINT `alarms_ibfk_2` FOREIGN KEY (`target_type`) REFERENCES `alarm_target` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `autoscalelog`
--
ALTER TABLE `autoscalelog`
  ADD CONSTRAINT `autoscalelog_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `node_group` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cluster_link`
--
ALTER TABLE `cluster_link`
  ADD CONSTRAINT `cluster_link_ibfk_1` FOREIGN KEY (`relation_id`) REFERENCES `cluster_relations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cluster_relations`
--
ALTER TABLE `cluster_relations`
  ADD CONSTRAINT `cluster_relations_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `node` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cluster_relations_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `node` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_statistics`
--
ALTER TABLE `group_statistics`
  ADD CONSTRAINT `group_statistics_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `node_group` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loc_regions`
--
ALTER TABLE `loc_regions`
  ADD CONSTRAINT `loc_regions_ibfk_1` FOREIGN KEY (`geozone_id`) REFERENCES `loc_geozones` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `node`
--
ALTER TABLE `node`
  ADD CONSTRAINT `node_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `node_group` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `node_group`
--
ALTER TABLE `node_group`
  ADD CONSTRAINT `node_group_ibfk_1` FOREIGN KEY (`scale_policy`) REFERENCES `scale_policies` (`name`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `node_group_ibfk_2` FOREIGN KEY (`launch_config`) REFERENCES `launch_configs` (`name`) ON UPDATE NO ACTION;

--
-- Constraints for table `node_info`
--
ALTER TABLE `node_info`
  ADD CONSTRAINT `node_info_ibfk_1` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `node_meta`
--
ALTER TABLE `node_meta`
  ADD CONSTRAINT `node_meta_ibfk_1` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `node_meta_ibfk_2` FOREIGN KEY (`meta_id`) REFERENCES `stream_meta` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stream_info`
--
ALTER TABLE `stream_info`
  ADD CONSTRAINT `stream_info_ibfk_1` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vod_stream_info`
--
ALTER TABLE `vod_stream_info`
  ADD CONSTRAINT `vod_stream_info_ibfk_1` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
