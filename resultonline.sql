USE [resultonlinelive]
GO
/****** Object:  Table [dbo].[accreditations]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[accreditations](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_accreditations_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[action_codes]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[action_codes](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[description] [nvarchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_action_codes_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[addresses]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[addresses](
	[id] [bigint] IDENTITY(20000000044,1) NOT NULL,
	[floor] [nvarchar](100) NULL,
	[unit] [nvarchar](40) NULL,
	[building_apartment] [nvarchar](100) NULL,
	[street_number] [nvarchar](100) NULL,
	[street_id] [bigint] NULL,
	[lot] [nvarchar](20) NULL,
	[block] [nvarchar](20) NULL,
	[village_id] [bigint] NULL,
	[town_city_id] [bigint] NULL,
	[province_state_id] [bigint] NULL,
	[country_id] [bigint] NULL,
	[longtitude] [nvarchar](40) NULL,
	[latitude] [nvarchar](40) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_addresses_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[advertisements]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[advertisements](
	[id] [int] IDENTITY(16,1) NOT NULL,
	[name] [varchar](250) NULL,
	[image] [varchar](250) NULL,
	[thumbnail] [varchar](250) NULL,
	[description] [varchar](max) NULL,
	[content] [varchar](max) NULL,
	[external_link] [varchar](250) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[status] [smallint] NULL,
	[start_datetime] [varchar](45) NULL,
	[end_datetime] [varchar](45) NULL,
	[user_id] [bigint] NOT NULL,
	[categorie_id] [int] NOT NULL,
	[type] [smallint] NULL,
	[company_branch_id] [int] NULL,
 CONSTRAINT [PK_advertisements_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[categories]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[categories](
	[id] [int] NOT NULL,
	[name] [varchar](250) NULL,
	[description] [varchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [int] NULL,
	[status] [smallint] NULL,
 CONSTRAINT [PK_categories_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[companies]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[companies](
	[id] [bigint] IDENTITY(222,1) NOT NULL,
	[name] [nvarchar](100) NULL,
	[type] [int] NULL,
	[industry_id] [bigint] NULL,
	[website] [nvarchar](100) NULL,
	[logo] [nvarchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_companies_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[company_branch_accreditations]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[company_branch_accreditations](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[company_branch_id] [bigint] NULL,
	[accreditation_id] [bigint] NULL,
	[accreditation_number] [nvarchar](100) NULL,
	[accreditation_date] [datetime2](0) NULL,
	[accreditation_renewal_date] [datetime2](0) NULL,
	[accreditation_expiration_date] [datetime2](0) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_company_branch_accreditations_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[company_branch_addresses]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[company_branch_addresses](
	[id] [bigint] IDENTITY(259,1) NOT NULL,
	[company_branch_id] [bigint] NULL,
	[address_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_company_branch_addresses_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[company_branch_contact_informations]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[company_branch_contact_informations](
	[id] [bigint] IDENTITY(466,1) NOT NULL,
	[company_branch_id] [bigint] NULL,
	[contact_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_company_branch_contact_informations_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[company_branch_images]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[company_branch_images](
	[id] [int] IDENTITY(3,1) NOT NULL,
	[company_branch_id] [bigint] NOT NULL,
	[title] [varchar](250) NULL,
	[thumbnail] [varchar](250) NULL,
	[image_id] [int] NULL,
	[description] [varchar](250) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
 CONSTRAINT [PK_company_branch_images_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [company_branch_images$id_UNIQUE] UNIQUE NONCLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[company_branch_info]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[company_branch_info](
	[id] [bigint] IDENTITY(270,1) NOT NULL,
	[company_branch_id] [bigint] NULL,
	[logo] [nvarchar](max) NULL,
	[mission] [nvarchar](max) NULL,
	[vision] [nvarchar](max) NULL,
	[website] [nvarchar](50) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_company_branch_info_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[company_branch_member_duties]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[company_branch_member_duties](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[company_branch_member_id] [bigint] NULL,
	[day] [int] NULL,
	[start_time] [time](7) NULL,
	[end_time] [time](7) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_company_branch_member_duties_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[company_branch_members]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[company_branch_members](
	[id] [bigint] IDENTITY(21,1) NOT NULL,
	[company_branch_id] [bigint] NULL,
	[users_id] [bigint] NULL,
	[role] [int] NULL,
	[enabled] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_company_branch_members_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[company_branch_operating_hours]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[company_branch_operating_hours](
	[id] [bigint] IDENTITY(2,1) NOT NULL,
	[company_branch_id] [bigint] NULL,
	[day] [int] NULL,
	[start_time] [time](7) NULL,
	[end_time] [time](7) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_company_branch_operating_hours_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[company_branch_services]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[company_branch_services](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[company_branch_id] [bigint] NULL,
	[service_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_company_branch_services_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[company_branches]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[company_branches](
	[id] [bigint] IDENTITY(312,1) NOT NULL,
	[application_key] [nvarchar](100) NULL,
	[name] [nvarchar](200) NULL,
	[company_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[status] [int] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_company_branches_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[contact_informations]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[contact_informations](
	[id] [bigint] IDENTITY(471,1) NOT NULL,
	[type] [int] NULL,
	[contact] [nvarchar](100) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_contact_informations_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[corporate_account_users]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[corporate_account_users](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[corporate_id] [bigint] NULL,
	[users_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [varchar](45) NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_corporate_account_users_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[corporate_accounts]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[corporate_accounts](
	[id] [bigint] IDENTITY(3,1) NOT NULL,
	[company_branch_id] [bigint] NULL,
	[type] [int] NULL,
	[class] [int] NULL,
	[status] [int] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validated] [smallint] NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
 CONSTRAINT [PK_corporate_accounts_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[country_codes]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[country_codes](
	[id] [bigint] IDENTITY(2,1) NOT NULL,
	[name] [nvarchar](100) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_country_codes_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[discounts]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[discounts](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[description] [nvarchar](max) NULL,
	[discount] [decimal](11, 2) NULL,
	[enabled] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_discounts_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[download_roles]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[download_roles](
	[id] [int] IDENTITY(4,1) NOT NULL,
	[file_id] [int] NULL,
	[role] [int] NULL,
	[user_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_download_roles_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[downloadable_files]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[downloadable_files](
	[id] [int] IDENTITY(2,1) NOT NULL,
	[name] [varchar](45) NULL,
	[file] [varchar](145) NULL,
	[description] [varchar](max) NULL,
	[status] [int] NULL,
	[slug] [varchar](45) NULL,
	[entry_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_downloadable_files_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[education_course_professions]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[education_course_professions](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[education_course_id] [bigint] NULL,
	[profession_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_education_course_professions_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[education_courses]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[education_courses](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[name] [varchar](40) NULL,
	[text] [varchar](40) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_education_courses_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[education_degrees]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[education_degrees](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[name] [varchar](40) NULL,
	[text] [varchar](40) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_education_degrees_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[education_levels]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[education_levels](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_education_levels_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[email_templates]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[email_templates](
	[id] [int] IDENTITY(11,1) NOT NULL,
	[subject] [varchar](100) NULL,
	[description] [varchar](max) NULL,
	[content] [varchar](max) NULL,
	[type] [int] NULL,
	[status] [int] NULL,
	[entry_datetime] [date] NULL,
	[user_id] [bigint] NULL,
 CONSTRAINT [PK_email_templates_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[identification_types]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[identification_types](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[internal_id] [nvarchar](40) NULL,
	[name] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[description] [nvarchar](max) NULL,
	[type] [int] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_identification_types_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[images]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[images](
	[id] [int] IDENTITY(173,1) NOT NULL,
	[image] [varchar](250) NULL,
	[post_content_id] [int] NOT NULL,
	[thumbnail] [varchar](250) NULL,
	[description] [varchar](max) NULL,
	[title] [varchar](250) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[post_id] [int] NULL,
 CONSTRAINT [PK_images_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[industries]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[industries](
	[id] [bigint] IDENTITY(4,1) NOT NULL,
	[name] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[description] [nvarchar](max) NULL,
	[health_risk_rating] [int] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_industries_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[insurance_provider_products]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[insurance_provider_products](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[insurance_provider_id] [bigint] NULL,
	[name] [varchar](100) NULL,
	[text] [varchar](100) NULL,
	[description] [varchar](max) NULL,
	[detail] [varchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_insurance_provider_products_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[insurance_providers]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[insurance_providers](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[company_branch_id] [bigint] NULL,
	[status] [int] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_insurance_providers_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratories]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratories](
	[id] [bigint] NOT NULL,
	[company_branch_id] [bigint] NULL,
	[type] [int] NULL,
	[class] [int] NULL,
	[status] [int] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratories_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_accepted_insurance]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_accepted_insurance](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[laboratory_id] [bigint] NULL,
	[insurance_provider_product_id] [bigint] NULL,
	[remarks] [varchar](max) NULL,
	[validity_start_date] [date] NULL,
	[validity_end_time] [date] NULL,
	[status] [int] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_accepted_insurance_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_corporate_partner_package_prices]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_corporate_partner_package_prices](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[laboratory_corporate_partner_id] [bigint] NULL,
	[package_id] [bigint] NULL,
	[enabled] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_corporate_partner_package_prices_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_corporate_partner_test_group_prices]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_corporate_partner_test_group_prices](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[laboratory_corporate_partner_id] [bigint] NULL,
	[test_group_price_id] [bigint] NULL,
	[enabled] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_corporate_partner_test_group_prices_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_corporate_partners]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_corporate_partners](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[laboratory_id] [bigint] NULL,
	[company_branch_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_corporate_partners_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_package_details]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_package_details](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[package_test_group_id] [bigint] NULL,
	[test_id] [bigint] NULL,
	[enabled] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_package_details_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_package_test_groups]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_package_test_groups](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[package_id] [bigint] NULL,
	[test_group_id] [bigint] NULL,
	[enabled] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_package_test_groups_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_packages]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_packages](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[laboratory_id] [bigint] NULL,
	[internal_id] [nvarchar](40) NULL,
	[name] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[description] [nvarchar](max) NULL,
	[expirable] [smallint] NULL,
	[validity_start_datetime] [datetime2](0) NULL,
	[validity_end_datetime] [datetime2](0) NULL,
	[price] [decimal](13, 4) NULL,
	[enabled] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[packages] [nchar](20) NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_packages_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_patient_batch_orders]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_patient_batch_orders](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[patient_order_id] [bigint] NULL,
	[batch_number] [int] NULL,
	[reference_number] [nvarchar](40) NULL,
	[total] [decimal](13, 4) NULL,
	[discount] [decimal](11, 4) NULL,
	[vat] [decimal](11, 4) NULL,
	[vat_amount] [decimal](11, 4) NULL,
	[amount_due] [decimal](13, 4) NULL,
	[requested_date] [date] NULL,
	[requested_time] [time](7) NULL,
	[confirmed] [smallint] NULL,
	[confirmed_date] [date] NULL,
	[confirmed_time] [time](7) NULL,
	[confirming_user_id] [bigint] NULL,
	[status] [int] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_patient_batch_orders_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_patient_batch_package_order_discounts]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_patient_batch_package_order_discounts](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[patient_batch_package_order_id] [int] NOT NULL,
	[discount_id] [int] NOT NULL,
	[discount] [decimal](11, 2) NULL,
	[amount] [decimal](11, 2) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [int] NULL,
 CONSTRAINT [PK_laboratory_patient_batch_package_order_discounts_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_patient_batch_package_orders]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_patient_batch_package_orders](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[patient_order_id] [bigint] NOT NULL,
	[specimen_id] [varchar](50) NOT NULL,
	[receipt_number] [varchar](50) NULL,
	[batch_number] [int] NULL,
	[total] [decimal](11, 2) NULL,
	[discount_amount] [decimal](11, 2) NULL,
	[vat] [decimal](11, 2) NULL,
	[vat_amount] [decimal](11, 2) NULL,
	[amount_due] [decimal](11, 2) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
 CONSTRAINT [PK_laboratory_patient_batch_package_orders_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_patient_order_details]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_patient_order_details](
	[id] [bigint] IDENTITY(12490,1) NOT NULL,
	[patient_order_id] [bigint] NOT NULL,
	[specimen_id] [varchar](50) NOT NULL,
	[confidential] [smallint] NULL,
	[last_name] [varchar](30) NULL,
	[first_name] [varchar](50) NULL,
	[middle_name] [varchar](30) NULL,
	[mother_maiden_name] [varchar](45) NULL,
	[alias] [varchar](100) NULL,
	[birthdate] [date] NULL,
	[age] [real] NULL,
	[sex] [varchar](3) NULL,
	[nationality] [varchar](50) NULL,
	[address] [varchar](255) NULL,
	[email] [varchar](40) NULL,
	[telephone_numbers] [varchar](100) NULL,
	[religion] [varchar](100) NULL,
	[marital_status] [char](1) NULL,
	[height] [real] NULL,
	[height_unit] [varchar](10) NULL,
	[weight] [real] NULL,
	[weight_unit] [varchar](10) NULL,
	[attending_physician_id] [bigint] NULL,
	[admitting_physician_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[changed_datetime] [datetime2](0) NULL,
	[changed_user_id] [bigint] NULL,
 CONSTRAINT [PK_laboratory_patient_order_details_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_patient_order_physicians]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_patient_order_physicians](
	[id] [bigint] IDENTITY(661,1) NOT NULL,
	[patient_order_id] [bigint] NULL,
	[laboratory_id] [bigint] NULL,
	[physician_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
 CONSTRAINT [PK_laboratory_patient_order_physicians_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_patient_orders]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_patient_orders](
	[id] [bigint] IDENTITY(1920,1) NOT NULL,
	[laboratory_id] [bigint] NULL,
	[company_branch_id] [bigint] NULL,
	[internal_id] [nvarchar](45) NULL,
	[patient_id] [bigint] NOT NULL,
	[total_amount_due] [decimal](13, 4) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [int] NULL,
	[status] [int] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
	[patient_transaction_id] [bigint] NULL,
	[specimen_id] [nvarchar](45) NULL,
	[external_specimen_id] [nvarchar](45) NULL,
	[other_specimen_id] [nvarchar](45) NULL,
	[link_order] [smallint] NULL,
	[linked_specimen_id] [nvarchar](45) NULL,
	[entry_type] [int] NULL,
	[admission_id] [int] NULL,
	[admission_date] [date] NULL,
	[admission_time] [time](7) NULL,
	[location_id] [int] NULL,
	[date_requested] [date] NULL,
	[time_requested] [time](7) NULL,
	[references] [nvarchar](100) NULL,
	[comments] [nvarchar](100) NULL,
	[applied_discounts] [decimal](10, 0) NULL,
	[comfirm_order] [smallint] NULL,
	[confirmation_date] [date] NULL,
	[confirmation_time] [time](7) NULL,
	[medical_department_id] [int] NULL,
 CONSTRAINT [PK_laboratory_patient_orders_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_patient_package_orders]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_patient_package_orders](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[patient_batch_package_order_id] [int] NOT NULL,
	[item_no] [int] NULL,
	[test_group_id] [bigint] NULL,
	[package_id] [bigint] NULL,
	[apply_main_discount] [smallint] NULL,
	[price] [decimal](11, 2) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
 CONSTRAINT [PK_laboratory_patient_package_orders_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_patient_transactions]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_patient_transactions](
	[id] [bigint] IDENTITY(1920,1) NOT NULL,
	[patient_id] [bigint] NOT NULL,
	[reference_number] [nvarchar](50) NULL,
	[remarks] [nvarchar](max) NULL,
	[grand_amount_due] [decimal](11, 2) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [int] NULL,
 CONSTRAINT [PK_laboratory_patient_transactions_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_release_levels]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_release_levels](
	[id] [varchar](20) NOT NULL,
	[name] [varchar](20) NULL,
	[description] [varchar](max) NULL,
	[sequence] [int] NULL,
	[for_release] [smallint] NULL,
	[internal_id] [int] NULL,
	[laboratory_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
 CONSTRAINT [PK_laboratory_release_levels_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_standard_test_groups]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_standard_test_groups](
	[id] [bigint] IDENTITY(40,1) NOT NULL,
	[name] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[description] [nvarchar](max) NULL,
	[iso] [nvarchar](100) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
 CONSTRAINT [PK_laboratory_standard_test_groups_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_standard_tests]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_standard_tests](
	[id] [bigint] IDENTITY(387,1) NOT NULL,
	[name] [varchar](40) NULL,
	[text] [varchar](40) NULL,
	[description] [varchar](max) NULL,
	[iso] [varchar](100) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
 CONSTRAINT [PK_laboratory_standard_tests_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_group_details]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_group_details](
	[id] [bigint] IDENTITY(298,1) NOT NULL,
	[test_group_id] [bigint] NULL,
	[test_id] [bigint] NULL,
	[specimen_type] [int] NULL,
	[result_type] [int] NULL,
	[test_set_id] [bigint] NULL,
	[display_order] [int] NULL,
	[default] [smallint] NULL,
	[enabled] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_test_group_details_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_group_prices]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_group_prices](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[test_group_id] [bigint] NULL,
	[name] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[description] [nvarchar](max) NULL,
	[priority] [int] NULL,
	[expirable] [smallint] NULL,
	[validity_start_datetime] [datetime2](0) NULL,
	[validity_end_datetime] [datetime2](0) NULL,
	[price] [decimal](13, 4) NULL,
	[enabled] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_test_group_prices_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_groups]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_groups](
	[id] [bigint] IDENTITY(40,1) NOT NULL,
	[standard_test_group_id] [bigint] NULL,
	[laboratory_id] [bigint] NULL,
	[internal_id] [nvarchar](40) NULL,
	[name] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[description] [nvarchar](max) NULL,
	[short_code] [nvarchar](10) NULL,
	[primary] [smallint] NULL,
	[panel_test] [smallint] NULL,
	[primary_test_group_id] [bigint] NULL,
	[default] [smallint] NULL,
	[department_id] [int] NULL,
	[specimen_type_id] [int] NULL,
	[price] [real] NULL,
	[enabled] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_test_groups_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_order_audit_logs]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_order_audit_logs](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[test_order_id] [bigint] NULL,
	[action_id] [bigint] NULL,
	[remarks] [nvarchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_test_order_audit_logs_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_order_details]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_order_details](
	[id] [bigint] IDENTITY(30001,1) NOT NULL,
	[test_result_id] [bigint] NULL,
	[patient_order_id] [bigint] NOT NULL,
	[order_status] [int] NULL,
	[test_id] [bigint] NULL,
	[panel_test_group_id] [bigint] NULL,
	[instrument_id] [varchar](50) NULL,
	[start_test_datetime] [datetime2](0) NULL,
	[end_test_datetime] [datetime2](0) NULL,
	[result_type] [int] NULL,
	[result_status] [int] NULL,
	[result_count] [int] NULL,
	[cancel_date] [date] NULL,
	[cancel_time] [time](7) NULL,
	[cancel_comments] [varchar](max) NULL,
	[cancelling_user_id] [bigint] NULL,
	[action_status] [int] NULL,
	[action_datetime] [datetime2](0) NULL,
	[action_user_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[repeated_test] [smallint] NULL,
	[preceeding_test_id] [varchar](20) NULL,
	[status] [int] NULL,
	[printed] [smallint] NULL,
	[secondary_specimen_id] [varchar](50) NULL,
	[patient_package_detail_id] [bigint] NULL,
 CONSTRAINT [PK_laboratory_test_order_details_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_order_medical_reports]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_order_medical_reports](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[test_order_id] [bigint] NULL,
	[medical_report_template_id] [bigint] NULL,
	[remarks] [nvarchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_test_order_medical_reports_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_order_package_medical_reports]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_order_package_medical_reports](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[test_order_package_id] [bigint] NULL,
	[medical_report_template_id] [bigint] NULL,
	[remarks] [nvarchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_test_order_package_medical_reports_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_order_results]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_order_results](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[test_order_detail_id] [bigint] NULL,
	[test_id] [bigint] NULL,
	[test_set_id] [bigint] NULL,
	[value] [varchar](max) NULL,
	[unit] [varchar](40) NULL,
	[si_value] [decimal](13, 4) NULL,
	[si_unit] [varchar](40) NULL,
	[si_reference_range] [varchar](100) NULL,
	[conventional_value] [decimal](13, 4) NULL,
	[conventional_unit] [varchar](40) NULL,
	[conventional_reference_range] [varchar](100) NULL,
	[result_flag] [varchar](40) NULL,
	[status] [int] NULL,
	[web_patient_viewable] [smallint] NULL,
	[web_physician_viewable] [smallint] NULL,
	[remarks] [varchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_test_order_results_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_orders]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_orders](
	[id] [bigint] IDENTITY(1920,1) NOT NULL,
	[patient_order_id] [bigint] NULL,
	[status] [int] NULL,
	[release_date] [date] NULL,
	[release_time] [time](7) NULL,
	[release_level_id] [int] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_test_orders_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_result_histories]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_result_histories](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[test_result_id] [bigint] NULL,
	[action_code] [int] NULL,
	[release_level_id] [varchar](20) NULL,
	[remarks] [varchar](45) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
 CONSTRAINT [PK_laboratory_test_result_histories_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_result_release_levels]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_result_release_levels](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[test_result_id] [bigint] NULL,
	[release_level_id] [varchar](20) NULL,
	[level_datetime] [datetime2](0) NULL,
	[comments] [varchar](max) NULL,
	[user_id] [int] NULL,
 CONSTRAINT [PK_laboratory_test_result_release_levels_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_result_specimen_histories]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_result_specimen_histories](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[test_result_specimen_id] [bigint] NOT NULL,
	[action_code] [int] NULL,
	[original_date] [date] NULL,
	[original_time] [time](7) NULL,
	[original_user_id] [int] NULL,
	[remarks] [varchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
 CONSTRAINT [PK_laboratory_test_result_specimen_histories_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_result_specimens]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_result_specimens](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[test_result_id] [bigint] NOT NULL,
	[status] [int] NULL,
	[extract_date] [date] NULL,
	[extract_time] [time](7) NULL,
	[extracting_user_id] [bigint] NULL,
	[extracting_remarks] [varchar](255) NULL,
	[checkin_date] [date] NULL,
	[checkin_time] [time](7) NULL,
	[checkin_user_id] [bigint] NULL,
	[accepted_time] [time](7) NULL,
	[accepted_date] [date] NULL,
	[accepting_user_id] [bigint] NULL,
	[reading_date] [date] NULL,
	[reading_time] [time](7) NULL,
	[reading_user_id] [bigint] NULL,
	[remarks] [varchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
 CONSTRAINT [PK_laboratory_test_result_specimens_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_results]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_results](
	[id] [bigint] IDENTITY(1920,1) NOT NULL,
	[test_order_id] [bigint] NULL,
	[test_group_id] [bigint] NULL,
	[order_type] [int] NULL,
	[result_status] [int] NULL,
	[remarks] [varchar](max) NULL,
	[order_status] [int] NULL,
	[release_level_id] [varchar](20) NULL,
	[release_date] [date] NULL,
	[release_time] [time](7) NULL,
	[cancel_date] [date] NULL,
	[cancel_time] [time](7) NULL,
	[cancel_comments] [varchar](max) NULL,
	[cancelling_user_id] [bigint] NULL,
	[lab_notes] [varchar](max) NULL,
	[medtech_user_id] [bigint] NULL,
	[other_medtech_user_id] [bigint] NULL,
	[pathologist_user_id] [bigint] NULL,
	[pdf_result] [smallint] NULL,
	[pdf_filename] [varchar](100) NULL,
	[printed] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
 CONSTRAINT [PK_laboratory_test_results_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_test_sets]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_test_sets](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[laboratory_id] [bigint] NULL,
	[name] [varchar](40) NULL,
	[text] [varchar](40) NULL,
	[description] [varchar](max) NULL,
	[enabled] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_test_sets_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laboratory_tests]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laboratory_tests](
	[id] [bigint] IDENTITY(375,1) NOT NULL,
	[standard_test_id] [bigint] NULL,
	[laboratory_id] [bigint] NULL,
	[internal_id] [varchar](40) NULL,
	[name] [varchar](40) NULL,
	[text] [varchar](40) NULL,
	[description] [varchar](max) NULL,
	[default] [smallint] NULL,
	[enabled] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_laboratory_tests_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[medical_report_templates]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[medical_report_templates](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[tags] [nvarchar](100) NULL,
	[report_type] [int] NULL,
	[template] [nvarchar](max) NULL,
	[enabled] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_medical_report_templates_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[messages]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[messages](
	[id] [int] IDENTITY(3,1) NOT NULL,
	[type] [smallint] NULL,
	[title] [varchar](250) NULL,
	[name] [varchar](100) NULL,
	[email] [varchar](100) NULL,
	[company] [varchar](100) NULL,
	[mobile_number] [varchar](100) NULL,
	[telephone_number] [varchar](100) NULL,
	[content] [varchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [varchar](45) NULL,
	[status] [smallint] NULL,
 CONSTRAINT [PK_messages_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[organizations_affliations]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[organizations_affliations](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_organizations_affliations_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[patients]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[patients](
	[id] [bigint] IDENTITY(1187,1) NOT NULL,
	[internal_id] [nvarchar](40) NULL,
	[person_id] [bigint] NULL,
	[laboratory_id] [bigint] NULL,
	[registered_date] [date] NULL,
	[registered_time] [time](7) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_patients_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[people]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[people](
	[id] [bigint] IDENTITY(2581,1) NOT NULL,
	[myresultonline_id] [nvarchar](200) NULL,
	[title_id] [bigint] NULL,
	[lastname] [nvarchar](60) NULL,
	[firstname] [nvarchar](60) NULL,
	[middlename] [nvarchar](60) NULL,
	[maidenname] [nvarchar](60) NULL,
	[nickname] [nvarchar](60) NULL,
	[suffix_id] [bigint] NULL,
	[birthdate] [datetime2](0) NULL,
	[sex] [nvarchar](6) NULL,
	[marital_status] [nvarchar](6) NULL,
	[father_person_id] [bigint] NULL,
	[mother_person_id] [bigint] NULL,
	[living_status] [int] NULL,
	[record_status] [int] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
	[mobile] [nchar](50) NULL,
 CONSTRAINT [PK_people_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[person_addresses]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[person_addresses](
	[id] [bigint] IDENTITY(5,1) NOT NULL,
	[person_id] [bigint] NULL,
	[address_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_person_addresses_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[person_aliases]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[person_aliases](
	[id] [bigint] IDENTITY(36,1) NOT NULL,
	[person_id] [bigint] NULL,
	[alias_person_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_person_aliases_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[person_contact_informations]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[person_contact_informations](
	[id] [bigint] IDENTITY(4,1) NOT NULL,
	[person_id] [bigint] NULL,
	[contact_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_person_contact_informations_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[person_educational_backgrounds]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[person_educational_backgrounds](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[person_id] [bigint] NULL,
	[school_id] [bigint] NULL,
	[start_date_coverage] [date] NULL,
	[end_date_coverage] [date] NULL,
	[education_level_id] [bigint] NULL,
	[education_degree_id] [bigint] NULL,
	[education_major_id] [bigint] NULL,
	[education_minor_id] [bigint] NULL,
	[graduate_type] [int] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_person_educational_backgrounds_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[person_expertise]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[person_expertise](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[person_id] [bigint] NULL,
	[description] [nvarchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_person_expertise_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[person_identifications]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[person_identifications](
	[id] [bigint] IDENTITY(18,1) NOT NULL,
	[person_id] [bigint] NULL,
	[identification_id] [bigint] NULL,
	[expiration_date] [datetime2](0) NULL,
	[reference_number] [nvarchar](100) NULL,
	[remarks] [nvarchar](max) NULL,
	[image] [nvarchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_person_identifications_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[person_identities]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[person_identities](
	[id] [bigint] IDENTITY(2593,1) NOT NULL,
	[users_id] [bigint] NULL,
	[person_id] [bigint] NULL,
	[laboratory_id] [bigint] NULL,
	[default] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_person_identities_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[person_images]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[person_images](
	[id] [int] IDENTITY(8,1) NOT NULL,
	[person_id] [bigint] NULL,
	[image_id] [bigint] NULL,
	[status] [int] NULL,
	[user_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_person_images_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[person_insurance]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[person_insurance](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[person_id] [bigint] NULL,
	[insurance_provider_product_id] [bigint] NULL,
	[insurance_number] [nvarchar](100) NULL,
	[effectivity_date] [date] NULL,
	[expiration_date] [date] NULL,
	[limit_details] [nvarchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_person_insurance_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[person_marks]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[person_marks](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[person_id] [bigint] NOT NULL,
	[type] [int] NULL,
	[finger] [int] NULL,
	[description] [varchar](max) NULL,
	[filename] [varchar](max) NULL,
	[default] [binary](1) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [binary](1) NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_person_marks_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[person_organizations_affiliations]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[person_organizations_affiliations](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[person_id] [bigint] NULL,
	[organization_id] [bigint] NULL,
	[date_member] [datetime2](0) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_person_organizations_affiliations_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[person_relatives]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[person_relatives](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[person_id] [bigint] NULL,
	[type] [int] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_person_relatives_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[person_work_experiences]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[person_work_experiences](
	[id] [bigint] NOT NULL,
	[person_id] [bigint] NULL,
	[title] [nvarchar](100) NULL,
	[company_branch_id] [bigint] NULL,
	[start_date_coverage] [date] NULL,
	[end_date_coverage] [date] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[physician_profile]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[physician_profile](
	[id] [bigint] IDENTITY(109,1) NOT NULL,
	[physician_id] [bigint] NULL,
	[key_competencies] [nvarchar](max) NULL,
	[practice_profile] [nvarchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
	[prc_number] [nvarchar](45) NULL,
	[issued_datetime] [date] NULL,
 CONSTRAINT [PK_physician_profile_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[physicians]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[physicians](
	[id] [bigint] IDENTITY(109,1) NOT NULL,
	[users_id] [bigint] NULL,
	[laboratory_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
	[internal_id] [nvarchar](45) NULL,
 CONSTRAINT [PK_physicians_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[post_contents]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[post_contents](
	[id] [int] IDENTITY(428,1) NOT NULL,
	[title] [varchar](500) NULL,
	[description] [varchar](max) NULL,
	[content] [varchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[rate] [int] NULL,
	[status] [smallint] NULL,
	[slug] [varchar](100) NULL,
	[post_id] [int] NOT NULL,
	[sequence] [int] NULL,
	[user_id] [bigint] NULL,
 CONSTRAINT [PK_post_contents_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[post_tags]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[post_tags](
	[id] [int] IDENTITY(22,1) NOT NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[enabled] [smallint] NULL,
	[tag_id] [int] NOT NULL,
	[post_content_id] [int] NOT NULL,
 CONSTRAINT [PK_post_tags_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[posts]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[posts](
	[id] [int] IDENTITY(208,1) NOT NULL,
	[description] [varchar](max) NULL,
	[type] [smallint] NULL,
	[title] [varchar](250) NULL,
	[status] [smallint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NOT NULL,
	[category_id] [int] NOT NULL,
	[slug] [varchar](100) NULL,
 CONSTRAINT [PK_posts_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[privileges]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[privileges](
	[id] [int] NOT NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [int] NULL,
 CONSTRAINT [PK_privileges_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[professions]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[professions](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[description] [nvarchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_professions_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[provinces_states_codes]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[provinces_states_codes](
	[id] [bigint] IDENTITY(84,1) NOT NULL,
	[provincial_region_id] [bigint] NULL,
	[name] [nvarchar](120) NULL,
	[text] [nvarchar](120) NULL,
	[iso] [nvarchar](40) NULL,
	[description] [nvarchar](120) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [int] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [int] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_provinces_states_codes_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[provincial_regions]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[provincial_regions](
	[id] [bigint] IDENTITY(18,1) NOT NULL,
	[name] [nvarchar](120) NULL,
	[text] [nvarchar](120) NULL,
	[iso] [nvarchar](40) NULL,
	[description] [nvarchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_provincial_regions_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[replies]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[replies](
	[id] [int] IDENTITY(14,1) NOT NULL,
	[name] [varchar](45) NULL,
	[email] [varchar](45) NULL,
	[content] [varchar](max) NULL,
	[post_content_id] [int] NOT NULL,
	[user_id] [bigint] NOT NULL,
	[rate] [int] NULL,
	[status] [smallint] NULL,
	[entry_datetime] [varchar](45) NULL,
	[reply_id] [bigint] NULL,
 CONSTRAINT [PK_replies_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[schools]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[schools](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[company_branch_id] [bigint] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_schools_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[services]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[services](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[type] [int] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_services_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[street_codes]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[street_codes](
	[id] [bigint] IDENTITY(20000000023,1) NOT NULL,
	[name] [nvarchar](100) NULL,
	[text] [nvarchar](100) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_street_codes_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[suffixes]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[suffixes](
	[id] [bigint] IDENTITY(9,1) NOT NULL,
	[display] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[description] [nvarchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_suffixes_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[sysdiagrams]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[sysdiagrams](
	[name] [nvarchar](160) NOT NULL,
	[principal_id] [int] NOT NULL,
	[diagram_id] [int] IDENTITY(2,1) NOT NULL,
	[version] [int] NULL,
	[definition] [varbinary](max) NULL,
 CONSTRAINT [PK_sysdiagrams_diagram_id] PRIMARY KEY CLUSTERED 
(
	[diagram_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [sysdiagrams$UK_principal_name] UNIQUE NONCLUSTERED 
(
	[principal_id] ASC,
	[name] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tags]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tags](
	[id] [int] IDENTITY(18,1) NOT NULL,
	[name] [varchar](250) NULL,
	[description] [varchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[status] [smallint] NULL,
	[category_id] [int] NOT NULL,
	[slug] [varchar](45) NULL,
 CONSTRAINT [PK_tags_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[title_codes]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[title_codes](
	[id] [bigint] IDENTITY(29,1) NOT NULL,
	[display] [nvarchar](40) NULL,
	[text] [nvarchar](40) NULL,
	[description] [nvarchar](max) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_title_codes_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tokens]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tokens](
	[id] [bigint] IDENTITY(1190,1) NOT NULL,
	[code] [nvarchar](100) NULL,
	[status] [nvarchar](100) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
 CONSTRAINT [PK_tokens_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[town_city_codes]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[town_city_codes](
	[id] [bigint] IDENTITY(1648,1) NOT NULL,
	[provinces_states_id] [bigint] NULL,
	[name] [nvarchar](120) NULL,
	[text] [nvarchar](120) NULL,
	[iso] [nvarchar](40) NULL,
	[description] [nvarchar](120) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_town_city_codes_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[users]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[users](
	[id] [bigint] IDENTITY(1337,1) NOT NULL,
	[username] [nvarchar](100) NULL,
	[password] [nvarchar](100) NULL,
	[role] [int] NULL,
	[last_login_datetime] [datetime2](0) NULL,
	[status] [int] NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[primary_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_users_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[village_codes]    Script Date: 15/03/2018 5:56:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[village_codes](
	[id] [bigint] IDENTITY(42027,1) NOT NULL,
	[town_city_id] [bigint] NULL,
	[name] [nvarchar](120) NULL,
	[text] [nvarchar](120) NULL,
	[iso] [nvarchar](40) NULL,
	[description] [nvarchar](120) NULL,
	[entry_datetime] [datetime2](0) NULL,
	[user_id] [bigint] NULL,
	[validated] [smallint] NULL,
	[validated_datetime] [datetime2](0) NULL,
	[validating_user_id] [bigint] NULL,
	[posted] [smallint] NULL,
	[posted_datetime] [datetime2](0) NULL,
 CONSTRAINT [PK_village_codes_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[accreditations] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[accreditations] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[accreditations] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[accreditations] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[accreditations] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[accreditations] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[accreditations] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[accreditations] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[accreditations] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[action_codes] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[action_codes] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[action_codes] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[action_codes] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[action_codes] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[action_codes] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [floor]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [unit]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [building_apartment]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [street_number]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [street_id]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [lot]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [block]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [village_id]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [town_city_id]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [province_state_id]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [country_id]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [longtitude]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [latitude]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[addresses] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[advertisements] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[advertisements] ADD  DEFAULT (NULL) FOR [image]
GO
ALTER TABLE [dbo].[advertisements] ADD  DEFAULT (NULL) FOR [thumbnail]
GO
ALTER TABLE [dbo].[advertisements] ADD  DEFAULT (NULL) FOR [external_link]
GO
ALTER TABLE [dbo].[advertisements] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[advertisements] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[advertisements] ADD  DEFAULT (NULL) FOR [start_datetime]
GO
ALTER TABLE [dbo].[advertisements] ADD  DEFAULT (NULL) FOR [end_datetime]
GO
ALTER TABLE [dbo].[advertisements] ADD  DEFAULT (NULL) FOR [type]
GO
ALTER TABLE [dbo].[advertisements] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[categories] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[categories] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[categories] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[categories] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[companies] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[companies] ADD  DEFAULT (NULL) FOR [type]
GO
ALTER TABLE [dbo].[companies] ADD  DEFAULT (NULL) FOR [industry_id]
GO
ALTER TABLE [dbo].[companies] ADD  DEFAULT (NULL) FOR [website]
GO
ALTER TABLE [dbo].[companies] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[companies] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[companies] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[companies] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[companies] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[companies] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[companies] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[company_branch_accreditations] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[company_branch_accreditations] ADD  DEFAULT (NULL) FOR [accreditation_id]
GO
ALTER TABLE [dbo].[company_branch_accreditations] ADD  DEFAULT (NULL) FOR [accreditation_number]
GO
ALTER TABLE [dbo].[company_branch_accreditations] ADD  DEFAULT (NULL) FOR [accreditation_date]
GO
ALTER TABLE [dbo].[company_branch_accreditations] ADD  DEFAULT (NULL) FOR [accreditation_renewal_date]
GO
ALTER TABLE [dbo].[company_branch_accreditations] ADD  DEFAULT (NULL) FOR [accreditation_expiration_date]
GO
ALTER TABLE [dbo].[company_branch_accreditations] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[company_branch_accreditations] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[company_branch_accreditations] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[company_branch_accreditations] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[company_branch_accreditations] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[company_branch_accreditations] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[company_branch_accreditations] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[company_branch_addresses] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[company_branch_addresses] ADD  DEFAULT (NULL) FOR [address_id]
GO
ALTER TABLE [dbo].[company_branch_addresses] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[company_branch_addresses] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[company_branch_addresses] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[company_branch_addresses] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[company_branch_contact_informations] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[company_branch_contact_informations] ADD  DEFAULT (NULL) FOR [contact_id]
GO
ALTER TABLE [dbo].[company_branch_contact_informations] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[company_branch_contact_informations] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[company_branch_contact_informations] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[company_branch_contact_informations] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[company_branch_images] ADD  DEFAULT (NULL) FOR [title]
GO
ALTER TABLE [dbo].[company_branch_images] ADD  DEFAULT (NULL) FOR [thumbnail]
GO
ALTER TABLE [dbo].[company_branch_images] ADD  DEFAULT (NULL) FOR [image_id]
GO
ALTER TABLE [dbo].[company_branch_images] ADD  DEFAULT (NULL) FOR [description]
GO
ALTER TABLE [dbo].[company_branch_images] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[company_branch_images] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[company_branch_images] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[company_branch_info] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[company_branch_info] ADD  DEFAULT (NULL) FOR [website]
GO
ALTER TABLE [dbo].[company_branch_info] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[company_branch_info] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[company_branch_info] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[company_branch_info] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[company_branch_member_duties] ADD  DEFAULT (NULL) FOR [company_branch_member_id]
GO
ALTER TABLE [dbo].[company_branch_member_duties] ADD  DEFAULT (NULL) FOR [day]
GO
ALTER TABLE [dbo].[company_branch_member_duties] ADD  DEFAULT (NULL) FOR [start_time]
GO
ALTER TABLE [dbo].[company_branch_member_duties] ADD  DEFAULT (NULL) FOR [end_time]
GO
ALTER TABLE [dbo].[company_branch_member_duties] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[company_branch_member_duties] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[company_branch_member_duties] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[company_branch_member_duties] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[company_branch_member_duties] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[company_branch_member_duties] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[company_branch_member_duties] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[company_branch_members] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[company_branch_members] ADD  DEFAULT (NULL) FOR [users_id]
GO
ALTER TABLE [dbo].[company_branch_members] ADD  DEFAULT (NULL) FOR [role]
GO
ALTER TABLE [dbo].[company_branch_members] ADD  DEFAULT (NULL) FOR [enabled]
GO
ALTER TABLE [dbo].[company_branch_members] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[company_branch_members] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[company_branch_members] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[company_branch_members] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[company_branch_operating_hours] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[company_branch_operating_hours] ADD  DEFAULT (NULL) FOR [day]
GO
ALTER TABLE [dbo].[company_branch_operating_hours] ADD  DEFAULT (NULL) FOR [start_time]
GO
ALTER TABLE [dbo].[company_branch_operating_hours] ADD  DEFAULT (NULL) FOR [end_time]
GO
ALTER TABLE [dbo].[company_branch_operating_hours] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[company_branch_operating_hours] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[company_branch_operating_hours] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[company_branch_operating_hours] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[company_branch_services] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[company_branch_services] ADD  DEFAULT (NULL) FOR [service_id]
GO
ALTER TABLE [dbo].[company_branch_services] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[company_branch_services] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[company_branch_services] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[company_branch_services] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[company_branches] ADD  DEFAULT (NULL) FOR [application_key]
GO
ALTER TABLE [dbo].[company_branches] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[company_branches] ADD  DEFAULT (NULL) FOR [company_id]
GO
ALTER TABLE [dbo].[company_branches] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[company_branches] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[company_branches] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[company_branches] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[company_branches] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[company_branches] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[company_branches] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[company_branches] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[contact_informations] ADD  DEFAULT (NULL) FOR [type]
GO
ALTER TABLE [dbo].[contact_informations] ADD  DEFAULT (NULL) FOR [contact]
GO
ALTER TABLE [dbo].[contact_informations] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[contact_informations] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[contact_informations] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[contact_informations] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[contact_informations] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[contact_informations] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[contact_informations] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[corporate_account_users] ADD  DEFAULT (NULL) FOR [corporate_id]
GO
ALTER TABLE [dbo].[corporate_account_users] ADD  DEFAULT (NULL) FOR [users_id]
GO
ALTER TABLE [dbo].[corporate_account_users] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[corporate_account_users] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[corporate_account_users] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[corporate_account_users] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[corporate_accounts] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[corporate_accounts] ADD  DEFAULT (NULL) FOR [type]
GO
ALTER TABLE [dbo].[corporate_accounts] ADD  DEFAULT (NULL) FOR [class]
GO
ALTER TABLE [dbo].[corporate_accounts] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[corporate_accounts] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[corporate_accounts] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[corporate_accounts] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[corporate_accounts] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[corporate_accounts] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[corporate_accounts] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[country_codes] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[country_codes] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[country_codes] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[country_codes] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[country_codes] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[country_codes] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[country_codes] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[country_codes] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[discounts] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[discounts] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[discounts] ADD  DEFAULT (NULL) FOR [discount]
GO
ALTER TABLE [dbo].[discounts] ADD  DEFAULT (NULL) FOR [enabled]
GO
ALTER TABLE [dbo].[discounts] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[discounts] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[discounts] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[discounts] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[download_roles] ADD  DEFAULT (NULL) FOR [file_id]
GO
ALTER TABLE [dbo].[download_roles] ADD  DEFAULT (NULL) FOR [role]
GO
ALTER TABLE [dbo].[download_roles] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[download_roles] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[downloadable_files] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[downloadable_files] ADD  DEFAULT (NULL) FOR [file]
GO
ALTER TABLE [dbo].[downloadable_files] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[downloadable_files] ADD  DEFAULT (NULL) FOR [slug]
GO
ALTER TABLE [dbo].[downloadable_files] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[education_course_professions] ADD  DEFAULT (NULL) FOR [education_course_id]
GO
ALTER TABLE [dbo].[education_course_professions] ADD  DEFAULT (NULL) FOR [profession_id]
GO
ALTER TABLE [dbo].[education_course_professions] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[education_course_professions] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[education_course_professions] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[education_course_professions] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[education_course_professions] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[education_course_professions] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[education_course_professions] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[education_courses] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[education_courses] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[education_courses] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[education_courses] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[education_courses] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[education_courses] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[education_courses] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[education_courses] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[education_courses] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[education_degrees] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[education_degrees] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[education_degrees] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[education_degrees] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[education_degrees] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[education_degrees] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[education_degrees] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[education_degrees] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[education_degrees] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[education_levels] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[education_levels] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[education_levels] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[education_levels] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[education_levels] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[education_levels] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[education_levels] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[education_levels] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[education_levels] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[email_templates] ADD  DEFAULT (NULL) FOR [subject]
GO
ALTER TABLE [dbo].[email_templates] ADD  DEFAULT (NULL) FOR [type]
GO
ALTER TABLE [dbo].[email_templates] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[email_templates] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[email_templates] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[identification_types] ADD  DEFAULT (NULL) FOR [internal_id]
GO
ALTER TABLE [dbo].[identification_types] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[identification_types] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[identification_types] ADD  DEFAULT (NULL) FOR [type]
GO
ALTER TABLE [dbo].[identification_types] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[identification_types] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[identification_types] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[identification_types] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[identification_types] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[identification_types] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[identification_types] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[images] ADD  DEFAULT (NULL) FOR [image]
GO
ALTER TABLE [dbo].[images] ADD  DEFAULT (NULL) FOR [thumbnail]
GO
ALTER TABLE [dbo].[images] ADD  DEFAULT (NULL) FOR [title]
GO
ALTER TABLE [dbo].[images] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[images] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[images] ADD  DEFAULT (NULL) FOR [post_id]
GO
ALTER TABLE [dbo].[industries] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[industries] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[industries] ADD  DEFAULT (NULL) FOR [health_risk_rating]
GO
ALTER TABLE [dbo].[industries] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[industries] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[industries] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[industries] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[industries] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[industries] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[industries] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[insurance_provider_products] ADD  DEFAULT (NULL) FOR [insurance_provider_id]
GO
ALTER TABLE [dbo].[insurance_provider_products] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[insurance_provider_products] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[insurance_provider_products] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[insurance_provider_products] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[insurance_provider_products] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[insurance_provider_products] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[insurance_provider_products] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[insurance_provider_products] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[insurance_provider_products] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[insurance_providers] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[insurance_providers] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[insurance_providers] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[insurance_providers] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[insurance_providers] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[insurance_providers] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[insurance_providers] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[insurance_providers] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[insurance_providers] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratories] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[laboratories] ADD  DEFAULT (NULL) FOR [type]
GO
ALTER TABLE [dbo].[laboratories] ADD  DEFAULT (NULL) FOR [class]
GO
ALTER TABLE [dbo].[laboratories] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[laboratories] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratories] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratories] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[laboratories] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[laboratories] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[laboratories] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratories] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_accepted_insurance] ADD  DEFAULT (NULL) FOR [laboratory_id]
GO
ALTER TABLE [dbo].[laboratory_accepted_insurance] ADD  DEFAULT (NULL) FOR [insurance_provider_product_id]
GO
ALTER TABLE [dbo].[laboratory_accepted_insurance] ADD  DEFAULT (NULL) FOR [validity_start_date]
GO
ALTER TABLE [dbo].[laboratory_accepted_insurance] ADD  DEFAULT (NULL) FOR [validity_end_time]
GO
ALTER TABLE [dbo].[laboratory_accepted_insurance] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[laboratory_accepted_insurance] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_accepted_insurance] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_accepted_insurance] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_accepted_insurance] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_package_prices] ADD  DEFAULT (NULL) FOR [laboratory_corporate_partner_id]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_package_prices] ADD  DEFAULT (NULL) FOR [package_id]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_package_prices] ADD  DEFAULT (NULL) FOR [enabled]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_package_prices] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_package_prices] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_package_prices] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_package_prices] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_test_group_prices] ADD  DEFAULT (NULL) FOR [laboratory_corporate_partner_id]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_test_group_prices] ADD  DEFAULT (NULL) FOR [test_group_price_id]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_test_group_prices] ADD  DEFAULT (NULL) FOR [enabled]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_test_group_prices] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_test_group_prices] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_test_group_prices] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_test_group_prices] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_corporate_partners] ADD  DEFAULT (NULL) FOR [laboratory_id]
GO
ALTER TABLE [dbo].[laboratory_corporate_partners] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[laboratory_corporate_partners] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_corporate_partners] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_corporate_partners] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_corporate_partners] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_package_details] ADD  DEFAULT (NULL) FOR [package_test_group_id]
GO
ALTER TABLE [dbo].[laboratory_package_details] ADD  DEFAULT (NULL) FOR [test_id]
GO
ALTER TABLE [dbo].[laboratory_package_details] ADD  DEFAULT (NULL) FOR [enabled]
GO
ALTER TABLE [dbo].[laboratory_package_details] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_package_details] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_package_details] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_package_details] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_package_test_groups] ADD  DEFAULT (NULL) FOR [package_id]
GO
ALTER TABLE [dbo].[laboratory_package_test_groups] ADD  DEFAULT (NULL) FOR [test_group_id]
GO
ALTER TABLE [dbo].[laboratory_package_test_groups] ADD  DEFAULT (NULL) FOR [enabled]
GO
ALTER TABLE [dbo].[laboratory_package_test_groups] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_package_test_groups] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_package_test_groups] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_package_test_groups] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [laboratory_id]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [internal_id]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [expirable]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [validity_start_datetime]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [validity_end_datetime]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [price]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [enabled]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [packages]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_packages] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [patient_order_id]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [batch_number]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [reference_number]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [total]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [discount]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [vat]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [vat_amount]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [amount_due]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [requested_date]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [requested_time]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [confirmed]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [confirmed_date]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [confirmed_time]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [confirming_user_id]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_order_discounts] ADD  DEFAULT (NULL) FOR [discount]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_order_discounts] ADD  DEFAULT (NULL) FOR [amount]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_order_discounts] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_order_discounts] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_orders] ADD  DEFAULT (NULL) FOR [receipt_number]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_orders] ADD  DEFAULT (NULL) FOR [batch_number]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_orders] ADD  DEFAULT (NULL) FOR [total]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_orders] ADD  DEFAULT (NULL) FOR [discount_amount]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_orders] ADD  DEFAULT (NULL) FOR [vat]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_orders] ADD  DEFAULT (NULL) FOR [vat_amount]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_orders] ADD  DEFAULT (NULL) FOR [amount_due]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_orders] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_orders] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [confidential]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [last_name]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [first_name]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [middle_name]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [mother_maiden_name]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [alias]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [birthdate]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [age]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [sex]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [nationality]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [email]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [telephone_numbers]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [religion]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [marital_status]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [height]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [height_unit]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [weight]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [weight_unit]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [attending_physician_id]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [admitting_physician_id]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [changed_datetime]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] ADD  DEFAULT (NULL) FOR [changed_user_id]
GO
ALTER TABLE [dbo].[laboratory_patient_order_physicians] ADD  DEFAULT (NULL) FOR [patient_order_id]
GO
ALTER TABLE [dbo].[laboratory_patient_order_physicians] ADD  DEFAULT (NULL) FOR [laboratory_id]
GO
ALTER TABLE [dbo].[laboratory_patient_order_physicians] ADD  DEFAULT (NULL) FOR [physician_id]
GO
ALTER TABLE [dbo].[laboratory_patient_order_physicians] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_patient_order_physicians] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [laboratory_id]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [internal_id]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [total_amount_due]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [patient_transaction_id]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [specimen_id]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [external_specimen_id]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [other_specimen_id]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [link_order]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [linked_specimen_id]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [entry_type]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [admission_id]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [admission_date]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [admission_time]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [location_id]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [date_requested]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [time_requested]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [references]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [comments]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [applied_discounts]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [comfirm_order]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [confirmation_date]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [confirmation_time]
GO
ALTER TABLE [dbo].[laboratory_patient_orders] ADD  DEFAULT (NULL) FOR [medical_department_id]
GO
ALTER TABLE [dbo].[laboratory_patient_package_orders] ADD  DEFAULT (NULL) FOR [item_no]
GO
ALTER TABLE [dbo].[laboratory_patient_package_orders] ADD  DEFAULT (NULL) FOR [test_group_id]
GO
ALTER TABLE [dbo].[laboratory_patient_package_orders] ADD  DEFAULT (NULL) FOR [package_id]
GO
ALTER TABLE [dbo].[laboratory_patient_package_orders] ADD  DEFAULT (NULL) FOR [apply_main_discount]
GO
ALTER TABLE [dbo].[laboratory_patient_package_orders] ADD  DEFAULT (NULL) FOR [price]
GO
ALTER TABLE [dbo].[laboratory_patient_package_orders] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_patient_package_orders] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_patient_transactions] ADD  DEFAULT (NULL) FOR [reference_number]
GO
ALTER TABLE [dbo].[laboratory_patient_transactions] ADD  DEFAULT (NULL) FOR [grand_amount_due]
GO
ALTER TABLE [dbo].[laboratory_patient_transactions] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_patient_transactions] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_release_levels] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[laboratory_release_levels] ADD  DEFAULT (NULL) FOR [sequence]
GO
ALTER TABLE [dbo].[laboratory_release_levels] ADD  DEFAULT (NULL) FOR [for_release]
GO
ALTER TABLE [dbo].[laboratory_release_levels] ADD  DEFAULT (NULL) FOR [internal_id]
GO
ALTER TABLE [dbo].[laboratory_release_levels] ADD  DEFAULT (NULL) FOR [laboratory_id]
GO
ALTER TABLE [dbo].[laboratory_release_levels] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_release_levels] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_standard_test_groups] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[laboratory_standard_test_groups] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[laboratory_standard_test_groups] ADD  DEFAULT (NULL) FOR [iso]
GO
ALTER TABLE [dbo].[laboratory_standard_test_groups] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_standard_test_groups] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_standard_test_groups] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[laboratory_standard_test_groups] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[laboratory_standard_test_groups] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[laboratory_standard_tests] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[laboratory_standard_tests] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[laboratory_standard_tests] ADD  DEFAULT (NULL) FOR [iso]
GO
ALTER TABLE [dbo].[laboratory_standard_tests] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_standard_tests] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_standard_tests] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[laboratory_standard_tests] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[laboratory_standard_tests] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [test_group_id]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [test_id]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [specimen_type]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [result_type]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [test_set_id]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [display_order]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [default]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [enabled]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_test_group_details] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [test_group_id]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [priority]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [expirable]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [validity_start_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [validity_end_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [price]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [enabled]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_test_group_prices] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [standard_test_group_id]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [laboratory_id]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [internal_id]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [short_code]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [primary]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [panel_test]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [primary_test_group_id]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [default]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [department_id]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [specimen_type_id]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [price]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [enabled]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_test_groups] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_order_audit_logs] ADD  DEFAULT (NULL) FOR [test_order_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_audit_logs] ADD  DEFAULT (NULL) FOR [action_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_audit_logs] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_order_audit_logs] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_audit_logs] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_test_order_audit_logs] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [test_result_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT ((0)) FOR [order_status]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [test_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [panel_test_group_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [instrument_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [start_test_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [end_test_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT ((0)) FOR [result_type]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT ((0)) FOR [result_status]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT ((0)) FOR [result_count]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [cancel_date]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [cancel_time]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [cancelling_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT ((0)) FOR [action_status]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [action_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [action_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [repeated_test]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [preceeding_test_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT ((1)) FOR [status]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [printed]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [secondary_specimen_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_details] ADD  DEFAULT (NULL) FOR [patient_package_detail_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_medical_reports] ADD  DEFAULT (NULL) FOR [test_order_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_medical_reports] ADD  DEFAULT (NULL) FOR [medical_report_template_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_medical_reports] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_order_medical_reports] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_medical_reports] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[laboratory_test_order_medical_reports] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_order_medical_reports] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_medical_reports] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_test_order_medical_reports] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_order_package_medical_reports] ADD  DEFAULT (NULL) FOR [test_order_package_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_package_medical_reports] ADD  DEFAULT (NULL) FOR [medical_report_template_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_package_medical_reports] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_order_package_medical_reports] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_package_medical_reports] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[laboratory_test_order_package_medical_reports] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_order_package_medical_reports] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_package_medical_reports] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_test_order_package_medical_reports] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [test_order_detail_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [test_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [test_set_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [unit]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [si_value]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [si_unit]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [si_reference_range]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [conventional_value]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [conventional_unit]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [conventional_reference_range]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [result_flag]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [web_patient_viewable]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [web_physician_viewable]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_test_order_results] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_orders] ADD  DEFAULT (NULL) FOR [patient_order_id]
GO
ALTER TABLE [dbo].[laboratory_test_orders] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[laboratory_test_orders] ADD  DEFAULT (NULL) FOR [release_date]
GO
ALTER TABLE [dbo].[laboratory_test_orders] ADD  DEFAULT (NULL) FOR [release_time]
GO
ALTER TABLE [dbo].[laboratory_test_orders] ADD  DEFAULT (NULL) FOR [release_level_id]
GO
ALTER TABLE [dbo].[laboratory_test_orders] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_orders] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_orders] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_test_orders] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_result_histories] ADD  DEFAULT (NULL) FOR [test_result_id]
GO
ALTER TABLE [dbo].[laboratory_test_result_histories] ADD  DEFAULT (NULL) FOR [action_code]
GO
ALTER TABLE [dbo].[laboratory_test_result_histories] ADD  DEFAULT (NULL) FOR [release_level_id]
GO
ALTER TABLE [dbo].[laboratory_test_result_histories] ADD  DEFAULT (NULL) FOR [remarks]
GO
ALTER TABLE [dbo].[laboratory_test_result_histories] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_result_histories] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_result_release_levels] ADD  DEFAULT (NULL) FOR [test_result_id]
GO
ALTER TABLE [dbo].[laboratory_test_result_release_levels] ADD  DEFAULT (NULL) FOR [release_level_id]
GO
ALTER TABLE [dbo].[laboratory_test_result_release_levels] ADD  DEFAULT (NULL) FOR [level_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_result_release_levels] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimen_histories] ADD  DEFAULT (NULL) FOR [action_code]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimen_histories] ADD  DEFAULT (NULL) FOR [original_date]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimen_histories] ADD  DEFAULT (NULL) FOR [original_time]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimen_histories] ADD  DEFAULT (NULL) FOR [original_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimen_histories] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimen_histories] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [extract_date]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [extract_time]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [extracting_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [checkin_date]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [checkin_time]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [checkin_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [accepted_time]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [accepted_date]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [accepting_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [reading_date]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [reading_time]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [reading_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [test_order_id]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [test_group_id]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [order_type]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT ((0)) FOR [result_status]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT ((0)) FOR [order_status]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [release_level_id]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [release_date]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [release_time]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [cancel_date]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [cancel_time]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [cancelling_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [medtech_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [other_medtech_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [pathologist_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [pdf_result]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [pdf_filename]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [printed]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_results] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_sets] ADD  DEFAULT (NULL) FOR [laboratory_id]
GO
ALTER TABLE [dbo].[laboratory_test_sets] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[laboratory_test_sets] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[laboratory_test_sets] ADD  DEFAULT (NULL) FOR [enabled]
GO
ALTER TABLE [dbo].[laboratory_test_sets] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_sets] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_test_sets] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[laboratory_test_sets] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[laboratory_test_sets] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[laboratory_test_sets] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_test_sets] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[laboratory_tests] ADD  DEFAULT (NULL) FOR [standard_test_id]
GO
ALTER TABLE [dbo].[laboratory_tests] ADD  DEFAULT (NULL) FOR [laboratory_id]
GO
ALTER TABLE [dbo].[laboratory_tests] ADD  DEFAULT (NULL) FOR [internal_id]
GO
ALTER TABLE [dbo].[laboratory_tests] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[laboratory_tests] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[laboratory_tests] ADD  DEFAULT (NULL) FOR [default]
GO
ALTER TABLE [dbo].[laboratory_tests] ADD  DEFAULT (NULL) FOR [enabled]
GO
ALTER TABLE [dbo].[laboratory_tests] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[laboratory_tests] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[laboratory_tests] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[laboratory_tests] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[laboratory_tests] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[laboratory_tests] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[laboratory_tests] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[medical_report_templates] ADD  DEFAULT (NULL) FOR [tags]
GO
ALTER TABLE [dbo].[medical_report_templates] ADD  DEFAULT (NULL) FOR [report_type]
GO
ALTER TABLE [dbo].[medical_report_templates] ADD  DEFAULT (NULL) FOR [enabled]
GO
ALTER TABLE [dbo].[medical_report_templates] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[medical_report_templates] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[medical_report_templates] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[medical_report_templates] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[medical_report_templates] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[medical_report_templates] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[medical_report_templates] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[messages] ADD  DEFAULT (NULL) FOR [type]
GO
ALTER TABLE [dbo].[messages] ADD  DEFAULT (NULL) FOR [title]
GO
ALTER TABLE [dbo].[messages] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[messages] ADD  DEFAULT (NULL) FOR [email]
GO
ALTER TABLE [dbo].[messages] ADD  DEFAULT (NULL) FOR [company]
GO
ALTER TABLE [dbo].[messages] ADD  DEFAULT (NULL) FOR [mobile_number]
GO
ALTER TABLE [dbo].[messages] ADD  DEFAULT (NULL) FOR [telephone_number]
GO
ALTER TABLE [dbo].[messages] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[messages] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[messages] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[organizations_affliations] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[organizations_affliations] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[organizations_affliations] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[organizations_affliations] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[organizations_affliations] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[organizations_affliations] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[organizations_affliations] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[organizations_affliations] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[organizations_affliations] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[patients] ADD  DEFAULT (NULL) FOR [internal_id]
GO
ALTER TABLE [dbo].[patients] ADD  DEFAULT (NULL) FOR [person_id]
GO
ALTER TABLE [dbo].[patients] ADD  DEFAULT (NULL) FOR [laboratory_id]
GO
ALTER TABLE [dbo].[patients] ADD  DEFAULT (NULL) FOR [registered_date]
GO
ALTER TABLE [dbo].[patients] ADD  DEFAULT (NULL) FOR [registered_time]
GO
ALTER TABLE [dbo].[patients] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[patients] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[patients] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[patients] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[patients] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[patients] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[patients] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__myresult__0CFADF99]  DEFAULT (NULL) FOR [myresultonline_id]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__title_id__0DEF03D2]  DEFAULT (NULL) FOR [title_id]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__lastname__0EE3280B]  DEFAULT (NULL) FOR [lastname]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__firstnam__0FD74C44]  DEFAULT (NULL) FOR [firstname]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__middlena__10CB707D]  DEFAULT (NULL) FOR [middlename]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__maidenna__11BF94B6]  DEFAULT (NULL) FOR [maidenname]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__nickname__12B3B8EF]  DEFAULT (NULL) FOR [nickname]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__suffix_i__13A7DD28]  DEFAULT (NULL) FOR [suffix_id]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__birthdat__149C0161]  DEFAULT (NULL) FOR [birthdate]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__sex__1590259A]  DEFAULT (NULL) FOR [sex]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__marital___168449D3]  DEFAULT (NULL) FOR [marital_status]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__father_p__17786E0C]  DEFAULT (NULL) FOR [father_person_id]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__mother_p__186C9245]  DEFAULT (NULL) FOR [mother_person_id]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__living_s__1960B67E]  DEFAULT (NULL) FOR [living_status]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__record_s__1A54DAB7]  DEFAULT (NULL) FOR [record_status]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__entry_da__1B48FEF0]  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__user_id__1C3D2329]  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__validate__1D314762]  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__validate__1E256B9B]  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__validati__1F198FD4]  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__posted__200DB40D]  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[people] ADD  CONSTRAINT [DF__people__posted_d__2101D846]  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[person_addresses] ADD  DEFAULT (NULL) FOR [person_id]
GO
ALTER TABLE [dbo].[person_addresses] ADD  DEFAULT (NULL) FOR [address_id]
GO
ALTER TABLE [dbo].[person_addresses] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[person_addresses] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[person_addresses] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[person_addresses] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[person_aliases] ADD  DEFAULT (NULL) FOR [person_id]
GO
ALTER TABLE [dbo].[person_aliases] ADD  DEFAULT (NULL) FOR [alias_person_id]
GO
ALTER TABLE [dbo].[person_aliases] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[person_aliases] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[person_aliases] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[person_aliases] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[person_contact_informations] ADD  DEFAULT (NULL) FOR [person_id]
GO
ALTER TABLE [dbo].[person_contact_informations] ADD  DEFAULT (NULL) FOR [contact_id]
GO
ALTER TABLE [dbo].[person_contact_informations] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[person_contact_informations] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[person_contact_informations] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[person_contact_informations] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[person_educational_backgrounds] ADD  DEFAULT (NULL) FOR [person_id]
GO
ALTER TABLE [dbo].[person_educational_backgrounds] ADD  DEFAULT (NULL) FOR [school_id]
GO
ALTER TABLE [dbo].[person_educational_backgrounds] ADD  DEFAULT (NULL) FOR [start_date_coverage]
GO
ALTER TABLE [dbo].[person_educational_backgrounds] ADD  DEFAULT (NULL) FOR [end_date_coverage]
GO
ALTER TABLE [dbo].[person_educational_backgrounds] ADD  DEFAULT (NULL) FOR [education_level_id]
GO
ALTER TABLE [dbo].[person_educational_backgrounds] ADD  DEFAULT (NULL) FOR [education_degree_id]
GO
ALTER TABLE [dbo].[person_educational_backgrounds] ADD  DEFAULT (NULL) FOR [education_major_id]
GO
ALTER TABLE [dbo].[person_educational_backgrounds] ADD  DEFAULT (NULL) FOR [education_minor_id]
GO
ALTER TABLE [dbo].[person_educational_backgrounds] ADD  DEFAULT (NULL) FOR [graduate_type]
GO
ALTER TABLE [dbo].[person_educational_backgrounds] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[person_educational_backgrounds] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[person_educational_backgrounds] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[person_educational_backgrounds] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[person_expertise] ADD  DEFAULT (NULL) FOR [person_id]
GO
ALTER TABLE [dbo].[person_expertise] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[person_expertise] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[person_expertise] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[person_expertise] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[person_identifications] ADD  DEFAULT (NULL) FOR [person_id]
GO
ALTER TABLE [dbo].[person_identifications] ADD  DEFAULT (NULL) FOR [identification_id]
GO
ALTER TABLE [dbo].[person_identifications] ADD  DEFAULT (NULL) FOR [expiration_date]
GO
ALTER TABLE [dbo].[person_identifications] ADD  DEFAULT (NULL) FOR [reference_number]
GO
ALTER TABLE [dbo].[person_identifications] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[person_identifications] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[person_identifications] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[person_identifications] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[person_identities] ADD  DEFAULT (NULL) FOR [users_id]
GO
ALTER TABLE [dbo].[person_identities] ADD  DEFAULT (NULL) FOR [person_id]
GO
ALTER TABLE [dbo].[person_identities] ADD  DEFAULT (NULL) FOR [laboratory_id]
GO
ALTER TABLE [dbo].[person_identities] ADD  DEFAULT (NULL) FOR [default]
GO
ALTER TABLE [dbo].[person_identities] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[person_identities] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[person_identities] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[person_identities] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[person_images] ADD  DEFAULT (NULL) FOR [person_id]
GO
ALTER TABLE [dbo].[person_images] ADD  DEFAULT (NULL) FOR [image_id]
GO
ALTER TABLE [dbo].[person_images] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[person_images] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[person_images] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[person_insurance] ADD  DEFAULT (NULL) FOR [person_id]
GO
ALTER TABLE [dbo].[person_insurance] ADD  DEFAULT (NULL) FOR [insurance_provider_product_id]
GO
ALTER TABLE [dbo].[person_insurance] ADD  DEFAULT (NULL) FOR [insurance_number]
GO
ALTER TABLE [dbo].[person_insurance] ADD  DEFAULT (NULL) FOR [effectivity_date]
GO
ALTER TABLE [dbo].[person_insurance] ADD  DEFAULT (NULL) FOR [expiration_date]
GO
ALTER TABLE [dbo].[person_insurance] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[person_insurance] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[person_insurance] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[person_insurance] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[person_marks] ADD  DEFAULT (NULL) FOR [type]
GO
ALTER TABLE [dbo].[person_marks] ADD  DEFAULT (NULL) FOR [finger]
GO
ALTER TABLE [dbo].[person_marks] ADD  DEFAULT (NULL) FOR [default]
GO
ALTER TABLE [dbo].[person_marks] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[person_marks] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[person_marks] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[person_marks] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[person_organizations_affiliations] ADD  DEFAULT (NULL) FOR [person_id]
GO
ALTER TABLE [dbo].[person_organizations_affiliations] ADD  DEFAULT (NULL) FOR [organization_id]
GO
ALTER TABLE [dbo].[person_organizations_affiliations] ADD  DEFAULT (NULL) FOR [date_member]
GO
ALTER TABLE [dbo].[person_organizations_affiliations] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[person_organizations_affiliations] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[person_organizations_affiliations] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[person_organizations_affiliations] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[person_relatives] ADD  DEFAULT (NULL) FOR [person_id]
GO
ALTER TABLE [dbo].[person_relatives] ADD  DEFAULT (NULL) FOR [type]
GO
ALTER TABLE [dbo].[person_relatives] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[person_relatives] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[person_relatives] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[person_relatives] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[person_relatives] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[person_relatives] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[person_relatives] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[person_work_experiences] ADD  DEFAULT (NULL) FOR [person_id]
GO
ALTER TABLE [dbo].[person_work_experiences] ADD  DEFAULT (NULL) FOR [title]
GO
ALTER TABLE [dbo].[person_work_experiences] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[person_work_experiences] ADD  DEFAULT (NULL) FOR [start_date_coverage]
GO
ALTER TABLE [dbo].[person_work_experiences] ADD  DEFAULT (NULL) FOR [end_date_coverage]
GO
ALTER TABLE [dbo].[person_work_experiences] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[person_work_experiences] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[person_work_experiences] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[person_work_experiences] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[physician_profile] ADD  DEFAULT (NULL) FOR [physician_id]
GO
ALTER TABLE [dbo].[physician_profile] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[physician_profile] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[physician_profile] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[physician_profile] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[physician_profile] ADD  DEFAULT (NULL) FOR [prc_number]
GO
ALTER TABLE [dbo].[physician_profile] ADD  DEFAULT (NULL) FOR [issued_datetime]
GO
ALTER TABLE [dbo].[physicians] ADD  DEFAULT (NULL) FOR [users_id]
GO
ALTER TABLE [dbo].[physicians] ADD  DEFAULT (NULL) FOR [laboratory_id]
GO
ALTER TABLE [dbo].[physicians] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[physicians] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[physicians] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[physicians] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[physicians] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[physicians] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[physicians] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[physicians] ADD  DEFAULT (NULL) FOR [internal_id]
GO
ALTER TABLE [dbo].[post_contents] ADD  DEFAULT (NULL) FOR [title]
GO
ALTER TABLE [dbo].[post_contents] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[post_contents] ADD  DEFAULT (NULL) FOR [rate]
GO
ALTER TABLE [dbo].[post_contents] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[post_contents] ADD  DEFAULT (NULL) FOR [slug]
GO
ALTER TABLE [dbo].[post_contents] ADD  DEFAULT (NULL) FOR [sequence]
GO
ALTER TABLE [dbo].[post_contents] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[post_tags] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[post_tags] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[post_tags] ADD  DEFAULT (NULL) FOR [enabled]
GO
ALTER TABLE [dbo].[posts] ADD  DEFAULT (NULL) FOR [type]
GO
ALTER TABLE [dbo].[posts] ADD  DEFAULT (NULL) FOR [title]
GO
ALTER TABLE [dbo].[posts] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[posts] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[posts] ADD  DEFAULT (NULL) FOR [slug]
GO
ALTER TABLE [dbo].[privileges] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[privileges] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[professions] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[professions] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[professions] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[professions] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[professions] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[professions] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[professions] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[professions] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[professions] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[provinces_states_codes] ADD  DEFAULT (NULL) FOR [provincial_region_id]
GO
ALTER TABLE [dbo].[provinces_states_codes] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[provinces_states_codes] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[provinces_states_codes] ADD  DEFAULT (NULL) FOR [iso]
GO
ALTER TABLE [dbo].[provinces_states_codes] ADD  DEFAULT (NULL) FOR [description]
GO
ALTER TABLE [dbo].[provinces_states_codes] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[provinces_states_codes] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[provinces_states_codes] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[provinces_states_codes] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[provinces_states_codes] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[provinces_states_codes] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[provinces_states_codes] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[provincial_regions] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[provincial_regions] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[provincial_regions] ADD  DEFAULT (NULL) FOR [iso]
GO
ALTER TABLE [dbo].[provincial_regions] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[provincial_regions] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[provincial_regions] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[provincial_regions] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[provincial_regions] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[provincial_regions] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[provincial_regions] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[replies] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[replies] ADD  DEFAULT (NULL) FOR [email]
GO
ALTER TABLE [dbo].[replies] ADD  DEFAULT (NULL) FOR [rate]
GO
ALTER TABLE [dbo].[replies] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[replies] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[replies] ADD  DEFAULT (NULL) FOR [reply_id]
GO
ALTER TABLE [dbo].[schools] ADD  DEFAULT (NULL) FOR [company_branch_id]
GO
ALTER TABLE [dbo].[schools] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[schools] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[schools] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[schools] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[services] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[services] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[services] ADD  DEFAULT (NULL) FOR [type]
GO
ALTER TABLE [dbo].[services] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[services] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[services] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[services] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[services] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[services] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[services] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[street_codes] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[street_codes] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[street_codes] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[street_codes] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[street_codes] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[street_codes] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[street_codes] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[street_codes] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[street_codes] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[suffixes] ADD  DEFAULT (NULL) FOR [display]
GO
ALTER TABLE [dbo].[suffixes] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[suffixes] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[suffixes] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[suffixes] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[suffixes] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[suffixes] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[suffixes] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[suffixes] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[sysdiagrams] ADD  DEFAULT (NULL) FOR [version]
GO
ALTER TABLE [dbo].[tags] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[tags] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[tags] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[tags] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[tags] ADD  DEFAULT (NULL) FOR [slug]
GO
ALTER TABLE [dbo].[title_codes] ADD  DEFAULT (NULL) FOR [display]
GO
ALTER TABLE [dbo].[title_codes] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[title_codes] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[title_codes] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[title_codes] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[title_codes] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[title_codes] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[title_codes] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[title_codes] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[tokens] ADD  DEFAULT (NULL) FOR [code]
GO
ALTER TABLE [dbo].[tokens] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[tokens] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[tokens] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[town_city_codes] ADD  DEFAULT (NULL) FOR [provinces_states_id]
GO
ALTER TABLE [dbo].[town_city_codes] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[town_city_codes] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[town_city_codes] ADD  DEFAULT (NULL) FOR [iso]
GO
ALTER TABLE [dbo].[town_city_codes] ADD  DEFAULT (NULL) FOR [description]
GO
ALTER TABLE [dbo].[town_city_codes] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[town_city_codes] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[town_city_codes] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[town_city_codes] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[town_city_codes] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[town_city_codes] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[town_city_codes] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [username]
GO
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [password]
GO
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [role]
GO
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [last_login_datetime]
GO
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [status]
GO
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [primary_user_id]
GO
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[village_codes] ADD  DEFAULT (NULL) FOR [town_city_id]
GO
ALTER TABLE [dbo].[village_codes] ADD  DEFAULT (NULL) FOR [name]
GO
ALTER TABLE [dbo].[village_codes] ADD  DEFAULT (NULL) FOR [text]
GO
ALTER TABLE [dbo].[village_codes] ADD  DEFAULT (NULL) FOR [iso]
GO
ALTER TABLE [dbo].[village_codes] ADD  DEFAULT (NULL) FOR [description]
GO
ALTER TABLE [dbo].[village_codes] ADD  DEFAULT (NULL) FOR [entry_datetime]
GO
ALTER TABLE [dbo].[village_codes] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[village_codes] ADD  DEFAULT (NULL) FOR [validated]
GO
ALTER TABLE [dbo].[village_codes] ADD  DEFAULT (NULL) FOR [validated_datetime]
GO
ALTER TABLE [dbo].[village_codes] ADD  DEFAULT (NULL) FOR [validating_user_id]
GO
ALTER TABLE [dbo].[village_codes] ADD  DEFAULT (NULL) FOR [posted]
GO
ALTER TABLE [dbo].[village_codes] ADD  DEFAULT (NULL) FOR [posted_datetime]
GO
ALTER TABLE [dbo].[addresses]  WITH NOCHECK ADD  CONSTRAINT [addresses$FK_addresses_country_codes] FOREIGN KEY([country_id])
REFERENCES [dbo].[country_codes] ([id])
GO
ALTER TABLE [dbo].[addresses] CHECK CONSTRAINT [addresses$FK_addresses_country_codes]
GO
ALTER TABLE [dbo].[addresses]  WITH NOCHECK ADD  CONSTRAINT [addresses$FK_addresses_provinces_states_codes] FOREIGN KEY([province_state_id])
REFERENCES [dbo].[provinces_states_codes] ([id])
GO
ALTER TABLE [dbo].[addresses] CHECK CONSTRAINT [addresses$FK_addresses_provinces_states_codes]
GO
ALTER TABLE [dbo].[addresses]  WITH NOCHECK ADD  CONSTRAINT [addresses$FK_addresses_street_codes] FOREIGN KEY([street_id])
REFERENCES [dbo].[street_codes] ([id])
GO
ALTER TABLE [dbo].[addresses] CHECK CONSTRAINT [addresses$FK_addresses_street_codes]
GO
ALTER TABLE [dbo].[addresses]  WITH NOCHECK ADD  CONSTRAINT [addresses$FK_addresses_town_city_codes] FOREIGN KEY([town_city_id])
REFERENCES [dbo].[town_city_codes] ([id])
GO
ALTER TABLE [dbo].[addresses] CHECK CONSTRAINT [addresses$FK_addresses_town_city_codes]
GO
ALTER TABLE [dbo].[addresses]  WITH NOCHECK ADD  CONSTRAINT [addresses$FK_addresses_village_codes] FOREIGN KEY([village_id])
REFERENCES [dbo].[village_codes] ([id])
GO
ALTER TABLE [dbo].[addresses] CHECK CONSTRAINT [addresses$FK_addresses_village_codes]
GO
ALTER TABLE [dbo].[companies]  WITH NOCHECK ADD  CONSTRAINT [companies$FK_companies_industries] FOREIGN KEY([industry_id])
REFERENCES [dbo].[industries] ([id])
GO
ALTER TABLE [dbo].[companies] CHECK CONSTRAINT [companies$FK_companies_industries]
GO
ALTER TABLE [dbo].[company_branch_accreditations]  WITH NOCHECK ADD  CONSTRAINT [company_branch_accreditations$FK_company_branch_accreditations_accreditations] FOREIGN KEY([accreditation_id])
REFERENCES [dbo].[accreditations] ([id])
GO
ALTER TABLE [dbo].[company_branch_accreditations] CHECK CONSTRAINT [company_branch_accreditations$FK_company_branch_accreditations_accreditations]
GO
ALTER TABLE [dbo].[company_branch_accreditations]  WITH NOCHECK ADD  CONSTRAINT [company_branch_accreditations$FK_company_branch_accreditations_company_branches] FOREIGN KEY([company_branch_id])
REFERENCES [dbo].[company_branches] ([id])
GO
ALTER TABLE [dbo].[company_branch_accreditations] CHECK CONSTRAINT [company_branch_accreditations$FK_company_branch_accreditations_company_branches]
GO
ALTER TABLE [dbo].[company_branch_addresses]  WITH NOCHECK ADD  CONSTRAINT [company_branch_addresses$FK_corporate_account_addresses_addresses] FOREIGN KEY([address_id])
REFERENCES [dbo].[addresses] ([id])
GO
ALTER TABLE [dbo].[company_branch_addresses] CHECK CONSTRAINT [company_branch_addresses$FK_corporate_account_addresses_addresses]
GO
ALTER TABLE [dbo].[company_branch_addresses]  WITH NOCHECK ADD  CONSTRAINT [company_branch_addresses$FK_corporate_account_addresses_company_branches] FOREIGN KEY([company_branch_id])
REFERENCES [dbo].[company_branches] ([id])
GO
ALTER TABLE [dbo].[company_branch_addresses] CHECK CONSTRAINT [company_branch_addresses$FK_corporate_account_addresses_company_branches]
GO
ALTER TABLE [dbo].[company_branch_contact_informations]  WITH NOCHECK ADD  CONSTRAINT [company_branch_contact_informations$FK_corporate_account_contact_informations_company_branches] FOREIGN KEY([company_branch_id])
REFERENCES [dbo].[company_branches] ([id])
GO
ALTER TABLE [dbo].[company_branch_contact_informations] CHECK CONSTRAINT [company_branch_contact_informations$FK_corporate_account_contact_informations_company_branches]
GO
ALTER TABLE [dbo].[company_branch_contact_informations]  WITH NOCHECK ADD  CONSTRAINT [company_branch_contact_informations$FK_corporate_account_contact_informations_contact_informations] FOREIGN KEY([contact_id])
REFERENCES [dbo].[contact_informations] ([id])
GO
ALTER TABLE [dbo].[company_branch_contact_informations] CHECK CONSTRAINT [company_branch_contact_informations$FK_corporate_account_contact_informations_contact_informations]
GO
ALTER TABLE [dbo].[company_branch_info]  WITH NOCHECK ADD  CONSTRAINT [company_branch_info$FK_company_branch_info_company_branches] FOREIGN KEY([company_branch_id])
REFERENCES [dbo].[company_branches] ([id])
GO
ALTER TABLE [dbo].[company_branch_info] CHECK CONSTRAINT [company_branch_info$FK_company_branch_info_company_branches]
GO
ALTER TABLE [dbo].[company_branch_member_duties]  WITH NOCHECK ADD  CONSTRAINT [company_branch_member_duties$FK_company_branch_member_duties_company_branch_members] FOREIGN KEY([company_branch_member_id])
REFERENCES [dbo].[company_branch_members] ([id])
GO
ALTER TABLE [dbo].[company_branch_member_duties] CHECK CONSTRAINT [company_branch_member_duties$FK_company_branch_member_duties_company_branch_members]
GO
ALTER TABLE [dbo].[company_branch_members]  WITH NOCHECK ADD  CONSTRAINT [company_branch_members$FK_corporate_account_users_company_branches] FOREIGN KEY([company_branch_id])
REFERENCES [dbo].[company_branches] ([id])
GO
ALTER TABLE [dbo].[company_branch_members] CHECK CONSTRAINT [company_branch_members$FK_corporate_account_users_company_branches]
GO
ALTER TABLE [dbo].[company_branch_operating_hours]  WITH NOCHECK ADD  CONSTRAINT [company_branch_operating_hours$FK_company_branch_operating_hours_company_branches] FOREIGN KEY([company_branch_id])
REFERENCES [dbo].[company_branches] ([id])
GO
ALTER TABLE [dbo].[company_branch_operating_hours] CHECK CONSTRAINT [company_branch_operating_hours$FK_company_branch_operating_hours_company_branches]
GO
ALTER TABLE [dbo].[company_branch_services]  WITH NOCHECK ADD  CONSTRAINT [company_branch_services$FK_company_branch_services_company_branches] FOREIGN KEY([company_branch_id])
REFERENCES [dbo].[company_branches] ([id])
GO
ALTER TABLE [dbo].[company_branch_services] CHECK CONSTRAINT [company_branch_services$FK_company_branch_services_company_branches]
GO
ALTER TABLE [dbo].[company_branch_services]  WITH NOCHECK ADD  CONSTRAINT [company_branch_services$FK_company_branch_services_services] FOREIGN KEY([service_id])
REFERENCES [dbo].[services] ([id])
GO
ALTER TABLE [dbo].[company_branch_services] CHECK CONSTRAINT [company_branch_services$FK_company_branch_services_services]
GO
ALTER TABLE [dbo].[company_branches]  WITH NOCHECK ADD  CONSTRAINT [company_branches$FK_company_branches_companies] FOREIGN KEY([company_id])
REFERENCES [dbo].[companies] ([id])
GO
ALTER TABLE [dbo].[company_branches] CHECK CONSTRAINT [company_branches$FK_company_branches_companies]
GO
ALTER TABLE [dbo].[corporate_account_users]  WITH NOCHECK ADD  CONSTRAINT [corporate_account_users$FK_corporate_account_user_accounts] FOREIGN KEY([corporate_id])
REFERENCES [dbo].[corporate_accounts] ([id])
GO
ALTER TABLE [dbo].[corporate_account_users] CHECK CONSTRAINT [corporate_account_users$FK_corporate_account_user_accounts]
GO
ALTER TABLE [dbo].[corporate_account_users]  WITH NOCHECK ADD  CONSTRAINT [corporate_account_users$FK_corporate_account_user_users] FOREIGN KEY([users_id])
REFERENCES [dbo].[users] ([id])
GO
ALTER TABLE [dbo].[corporate_account_users] CHECK CONSTRAINT [corporate_account_users$FK_corporate_account_user_users]
GO
ALTER TABLE [dbo].[corporate_accounts]  WITH NOCHECK ADD  CONSTRAINT [corporate_accounts$FK_company_branches_companies1] FOREIGN KEY([company_branch_id])
REFERENCES [dbo].[company_branches] ([id])
GO
ALTER TABLE [dbo].[corporate_accounts] CHECK CONSTRAINT [corporate_accounts$FK_company_branches_companies1]
GO
ALTER TABLE [dbo].[education_course_professions]  WITH NOCHECK ADD  CONSTRAINT [education_course_professions$FK_education_course_professions_education_courses] FOREIGN KEY([education_course_id])
REFERENCES [dbo].[education_courses] ([id])
GO
ALTER TABLE [dbo].[education_course_professions] CHECK CONSTRAINT [education_course_professions$FK_education_course_professions_education_courses]
GO
ALTER TABLE [dbo].[education_course_professions]  WITH NOCHECK ADD  CONSTRAINT [education_course_professions$FK_education_course_professions_professions] FOREIGN KEY([profession_id])
REFERENCES [dbo].[professions] ([id])
GO
ALTER TABLE [dbo].[education_course_professions] CHECK CONSTRAINT [education_course_professions$FK_education_course_professions_professions]
GO
ALTER TABLE [dbo].[insurance_provider_products]  WITH NOCHECK ADD  CONSTRAINT [insurance_provider_products$FK_insurance_provider_products_insurance_providers] FOREIGN KEY([insurance_provider_id])
REFERENCES [dbo].[insurance_providers] ([id])
GO
ALTER TABLE [dbo].[insurance_provider_products] CHECK CONSTRAINT [insurance_provider_products$FK_insurance_provider_products_insurance_providers]
GO
ALTER TABLE [dbo].[insurance_providers]  WITH NOCHECK ADD  CONSTRAINT [insurance_providers$FK_insurance_providers_company_branches] FOREIGN KEY([company_branch_id])
REFERENCES [dbo].[company_branches] ([id])
GO
ALTER TABLE [dbo].[insurance_providers] CHECK CONSTRAINT [insurance_providers$FK_insurance_providers_company_branches]
GO
ALTER TABLE [dbo].[laboratories]  WITH NOCHECK ADD  CONSTRAINT [laboratories$FK_laboratories_company_branches] FOREIGN KEY([company_branch_id])
REFERENCES [dbo].[company_branches] ([id])
GO
ALTER TABLE [dbo].[laboratories] CHECK CONSTRAINT [laboratories$FK_laboratories_company_branches]
GO
ALTER TABLE [dbo].[laboratory_accepted_insurance]  WITH NOCHECK ADD  CONSTRAINT [laboratory_accepted_insurance$FK_laboratory_accepted_insurance_insurance_provider_products] FOREIGN KEY([insurance_provider_product_id])
REFERENCES [dbo].[insurance_provider_products] ([id])
GO
ALTER TABLE [dbo].[laboratory_accepted_insurance] CHECK CONSTRAINT [laboratory_accepted_insurance$FK_laboratory_accepted_insurance_insurance_provider_products]
GO
ALTER TABLE [dbo].[laboratory_accepted_insurance]  WITH NOCHECK ADD  CONSTRAINT [laboratory_accepted_insurance$FK_laboratory_accepted_insurance_laboratories] FOREIGN KEY([laboratory_id])
REFERENCES [dbo].[laboratories] ([id])
GO
ALTER TABLE [dbo].[laboratory_accepted_insurance] CHECK CONSTRAINT [laboratory_accepted_insurance$FK_laboratory_accepted_insurance_laboratories]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_package_prices]  WITH NOCHECK ADD  CONSTRAINT [laboratory_corporate_partner_package_prices$FK_laboratory_corporate_partner_package_prices_laboratory_corp5] FOREIGN KEY([laboratory_corporate_partner_id])
REFERENCES [dbo].[laboratory_corporate_partners] ([id])
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_package_prices] CHECK CONSTRAINT [laboratory_corporate_partner_package_prices$FK_laboratory_corporate_partner_package_prices_laboratory_corp5]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_package_prices]  WITH NOCHECK ADD  CONSTRAINT [laboratory_corporate_partner_package_prices$FK_laboratory_corporate_partner_package_prices_laboratory_pack6] FOREIGN KEY([package_id])
REFERENCES [dbo].[laboratory_packages] ([id])
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_package_prices] CHECK CONSTRAINT [laboratory_corporate_partner_package_prices$FK_laboratory_corporate_partner_package_prices_laboratory_pack6]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_test_group_prices]  WITH NOCHECK ADD  CONSTRAINT [laboratory_corporate_partner_test_group_prices$FK_laboratory_corporate_partnet_test_group_prices_laboratory_c7] FOREIGN KEY([laboratory_corporate_partner_id])
REFERENCES [dbo].[laboratory_corporate_partners] ([id])
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_test_group_prices] CHECK CONSTRAINT [laboratory_corporate_partner_test_group_prices$FK_laboratory_corporate_partnet_test_group_prices_laboratory_c7]
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_test_group_prices]  WITH NOCHECK ADD  CONSTRAINT [laboratory_corporate_partner_test_group_prices$FK_laboratory_corporate_partnet_test_group_prices_laboratory_t8] FOREIGN KEY([test_group_price_id])
REFERENCES [dbo].[laboratory_test_group_prices] ([id])
GO
ALTER TABLE [dbo].[laboratory_corporate_partner_test_group_prices] CHECK CONSTRAINT [laboratory_corporate_partner_test_group_prices$FK_laboratory_corporate_partnet_test_group_prices_laboratory_t8]
GO
ALTER TABLE [dbo].[laboratory_corporate_partners]  WITH NOCHECK ADD  CONSTRAINT [laboratory_corporate_partners$FK_laboratory_corporate_partners_company_branches] FOREIGN KEY([company_branch_id])
REFERENCES [dbo].[company_branches] ([id])
GO
ALTER TABLE [dbo].[laboratory_corporate_partners] CHECK CONSTRAINT [laboratory_corporate_partners$FK_laboratory_corporate_partners_company_branches]
GO
ALTER TABLE [dbo].[laboratory_corporate_partners]  WITH NOCHECK ADD  CONSTRAINT [laboratory_corporate_partners$FK_laboratory_corporate_partners_laboratories] FOREIGN KEY([laboratory_id])
REFERENCES [dbo].[laboratories] ([id])
GO
ALTER TABLE [dbo].[laboratory_corporate_partners] CHECK CONSTRAINT [laboratory_corporate_partners$FK_laboratory_corporate_partners_laboratories]
GO
ALTER TABLE [dbo].[laboratory_package_details]  WITH NOCHECK ADD  CONSTRAINT [laboratory_package_details$FK_package_details_package_test_groups] FOREIGN KEY([package_test_group_id])
REFERENCES [dbo].[laboratory_package_test_groups] ([id])
GO
ALTER TABLE [dbo].[laboratory_package_details] CHECK CONSTRAINT [laboratory_package_details$FK_package_details_package_test_groups]
GO
ALTER TABLE [dbo].[laboratory_package_test_groups]  WITH NOCHECK ADD  CONSTRAINT [laboratory_package_test_groups$FK_package_test_groups_packages] FOREIGN KEY([package_id])
REFERENCES [dbo].[laboratory_packages] ([id])
GO
ALTER TABLE [dbo].[laboratory_package_test_groups] CHECK CONSTRAINT [laboratory_package_test_groups$FK_package_test_groups_packages]
GO
ALTER TABLE [dbo].[laboratory_packages]  WITH NOCHECK ADD  CONSTRAINT [laboratory_packages$FK_packages_laboratories] FOREIGN KEY([laboratory_id])
REFERENCES [dbo].[laboratories] ([id])
GO
ALTER TABLE [dbo].[laboratory_packages] CHECK CONSTRAINT [laboratory_packages$FK_packages_laboratories]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders]  WITH NOCHECK ADD  CONSTRAINT [laboratory_patient_batch_orders$FK_patient_batch_orders_patient_orders] FOREIGN KEY([patient_order_id])
REFERENCES [dbo].[laboratory_patient_orders] ([id])
GO
ALTER TABLE [dbo].[laboratory_patient_batch_orders] CHECK CONSTRAINT [laboratory_patient_batch_orders$FK_patient_batch_orders_patient_orders]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_order_discounts]  WITH NOCHECK ADD  CONSTRAINT [laboratory_patient_batch_package_order_discounts$fk_patient_package_order_discounts_patient_batch_package_orde1] FOREIGN KEY([patient_batch_package_order_id])
REFERENCES [dbo].[laboratory_patient_batch_package_orders] ([id])
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_order_discounts] CHECK CONSTRAINT [laboratory_patient_batch_package_order_discounts$fk_patient_package_order_discounts_patient_batch_package_orde1]
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_orders]  WITH NOCHECK ADD  CONSTRAINT [laboratory_patient_batch_package_orders$fk_patient_batch_package_orders_patient_orders1] FOREIGN KEY([patient_order_id])
REFERENCES [dbo].[laboratory_patient_orders] ([id])
GO
ALTER TABLE [dbo].[laboratory_patient_batch_package_orders] CHECK CONSTRAINT [laboratory_patient_batch_package_orders$fk_patient_batch_package_orders_patient_orders1]
GO
ALTER TABLE [dbo].[laboratory_patient_order_details]  WITH NOCHECK ADD  CONSTRAINT [laboratory_patient_order_details$fk_patient_order_details_patient_orders1] FOREIGN KEY([patient_order_id])
REFERENCES [dbo].[laboratory_patient_orders] ([id])
GO
ALTER TABLE [dbo].[laboratory_patient_order_details] CHECK CONSTRAINT [laboratory_patient_order_details$fk_patient_order_details_patient_orders1]
GO
ALTER TABLE [dbo].[laboratory_patient_order_physicians]  WITH NOCHECK ADD  CONSTRAINT [laboratory_patient_order_physicians$fk_patient_orders_laboratories1] FOREIGN KEY([laboratory_id])
REFERENCES [dbo].[laboratories] ([id])
GO
ALTER TABLE [dbo].[laboratory_patient_order_physicians] CHECK CONSTRAINT [laboratory_patient_order_physicians$fk_patient_orders_laboratories1]
GO
ALTER TABLE [dbo].[laboratory_patient_order_physicians]  WITH NOCHECK ADD  CONSTRAINT [laboratory_patient_order_physicians$fk_patient_orders_physicians_patient_orders1] FOREIGN KEY([patient_order_id])
REFERENCES [dbo].[laboratory_patient_orders] ([id])
GO
ALTER TABLE [dbo].[laboratory_patient_order_physicians] CHECK CONSTRAINT [laboratory_patient_order_physicians$fk_patient_orders_physicians_patient_orders1]
GO
ALTER TABLE [dbo].[laboratory_patient_orders]  WITH NOCHECK ADD  CONSTRAINT [laboratory_patient_orders$FK_patient_orders_company_branches] FOREIGN KEY([company_branch_id])
REFERENCES [dbo].[company_branches] ([id])
GO
ALTER TABLE [dbo].[laboratory_patient_orders] CHECK CONSTRAINT [laboratory_patient_orders$FK_patient_orders_company_branches]
GO
ALTER TABLE [dbo].[laboratory_patient_orders]  WITH NOCHECK ADD  CONSTRAINT [laboratory_patient_orders$FK_patient_orders_laboratories] FOREIGN KEY([laboratory_id])
REFERENCES [dbo].[laboratories] ([id])
GO
ALTER TABLE [dbo].[laboratory_patient_orders] CHECK CONSTRAINT [laboratory_patient_orders$FK_patient_orders_laboratories]
GO
ALTER TABLE [dbo].[laboratory_patient_orders]  WITH NOCHECK ADD  CONSTRAINT [laboratory_patient_orders$FK_patient_transactions] FOREIGN KEY([patient_transaction_id])
REFERENCES [dbo].[laboratory_patient_transactions] ([id])
GO
ALTER TABLE [dbo].[laboratory_patient_orders] CHECK CONSTRAINT [laboratory_patient_orders$FK_patient_transactions]
GO
ALTER TABLE [dbo].[laboratory_patient_package_orders]  WITH NOCHECK ADD  CONSTRAINT [laboratory_patient_package_orders$fk_patient_order_details_packages1] FOREIGN KEY([package_id])
REFERENCES [dbo].[laboratory_packages] ([id])
GO
ALTER TABLE [dbo].[laboratory_patient_package_orders] CHECK CONSTRAINT [laboratory_patient_package_orders$fk_patient_order_details_packages1]
GO
ALTER TABLE [dbo].[laboratory_patient_package_orders]  WITH NOCHECK ADD  CONSTRAINT [laboratory_patient_package_orders$fk_patient_package_orders_patient_batch_package_orders1] FOREIGN KEY([patient_batch_package_order_id])
REFERENCES [dbo].[laboratory_patient_batch_package_orders] ([id])
GO
ALTER TABLE [dbo].[laboratory_patient_package_orders] CHECK CONSTRAINT [laboratory_patient_package_orders$fk_patient_package_orders_patient_batch_package_orders1]
GO
ALTER TABLE [dbo].[laboratory_test_group_details]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_group_details$FK_test_group_details_test_sets] FOREIGN KEY([test_set_id])
REFERENCES [dbo].[laboratory_test_sets] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_group_details] CHECK CONSTRAINT [laboratory_test_group_details$FK_test_group_details_test_sets]
GO
ALTER TABLE [dbo].[laboratory_test_groups]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_groups$FK_test_groups_laboratories] FOREIGN KEY([laboratory_id])
REFERENCES [dbo].[laboratories] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_groups] CHECK CONSTRAINT [laboratory_test_groups$FK_test_groups_laboratories]
GO
ALTER TABLE [dbo].[laboratory_test_order_audit_logs]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_order_audit_logs$FK_test_order_audit_logs_action_codes] FOREIGN KEY([action_id])
REFERENCES [dbo].[action_codes] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_order_audit_logs] CHECK CONSTRAINT [laboratory_test_order_audit_logs$FK_test_order_audit_logs_action_codes]
GO
ALTER TABLE [dbo].[laboratory_test_order_audit_logs]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_order_audit_logs$FK_test_order_audit_logs_test_orders] FOREIGN KEY([test_order_id])
REFERENCES [dbo].[laboratory_test_orders] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_order_audit_logs] CHECK CONSTRAINT [laboratory_test_order_audit_logs$FK_test_order_audit_logs_test_orders]
GO
ALTER TABLE [dbo].[laboratory_test_order_details]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_order_details$fk_test_order_details_patient_orders1] FOREIGN KEY([patient_order_id])
REFERENCES [dbo].[laboratory_patient_orders] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_order_details] CHECK CONSTRAINT [laboratory_test_order_details$fk_test_order_details_patient_orders1]
GO
ALTER TABLE [dbo].[laboratory_test_order_details]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_order_details$fk_test_order_details_test_result1] FOREIGN KEY([test_result_id])
REFERENCES [dbo].[laboratory_test_results] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_order_details] CHECK CONSTRAINT [laboratory_test_order_details$fk_test_order_details_test_result1]
GO
ALTER TABLE [dbo].[laboratory_test_order_details]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_order_details$fk_test_order_details_tests1] FOREIGN KEY([test_id])
REFERENCES [dbo].[laboratory_tests] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_order_details] CHECK CONSTRAINT [laboratory_test_order_details$fk_test_order_details_tests1]
GO
ALTER TABLE [dbo].[laboratory_test_order_medical_reports]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_order_medical_reports$FK_test_order_medical_reports_medical_report_templates] FOREIGN KEY([medical_report_template_id])
REFERENCES [dbo].[medical_report_templates] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_order_medical_reports] CHECK CONSTRAINT [laboratory_test_order_medical_reports$FK_test_order_medical_reports_medical_report_templates]
GO
ALTER TABLE [dbo].[laboratory_test_order_medical_reports]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_order_medical_reports$FK_test_order_medical_reports_test_orders] FOREIGN KEY([test_order_id])
REFERENCES [dbo].[laboratory_test_orders] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_order_medical_reports] CHECK CONSTRAINT [laboratory_test_order_medical_reports$FK_test_order_medical_reports_test_orders]
GO
ALTER TABLE [dbo].[laboratory_test_order_package_medical_reports]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_order_package_medical_reports$FK_test_order_package_medical_reports_medical_report_templates] FOREIGN KEY([medical_report_template_id])
REFERENCES [dbo].[medical_report_templates] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_order_package_medical_reports] CHECK CONSTRAINT [laboratory_test_order_package_medical_reports$FK_test_order_package_medical_reports_medical_report_templates]
GO
ALTER TABLE [dbo].[laboratory_test_order_results]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_order_results$FK_test_order_results_test_order_packages] FOREIGN KEY([test_order_detail_id])
REFERENCES [dbo].[laboratory_test_order_details] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_order_results] CHECK CONSTRAINT [laboratory_test_order_results$FK_test_order_results_test_order_packages]
GO
ALTER TABLE [dbo].[laboratory_test_orders]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_orders$FK_test_orders_patient_orders] FOREIGN KEY([patient_order_id])
REFERENCES [dbo].[laboratory_patient_orders] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_orders] CHECK CONSTRAINT [laboratory_test_orders$FK_test_orders_patient_orders]
GO
ALTER TABLE [dbo].[laboratory_test_result_histories]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_result_histories$fk_test_result_histories_release_levels1] FOREIGN KEY([release_level_id])
REFERENCES [dbo].[laboratory_release_levels] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_result_histories] CHECK CONSTRAINT [laboratory_test_result_histories$fk_test_result_histories_release_levels1]
GO
ALTER TABLE [dbo].[laboratory_test_result_histories]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_result_histories$fk_test_result_histories_test_results1] FOREIGN KEY([test_result_id])
REFERENCES [dbo].[laboratory_test_results] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_result_histories] CHECK CONSTRAINT [laboratory_test_result_histories$fk_test_result_histories_test_results1]
GO
ALTER TABLE [dbo].[laboratory_test_result_release_levels]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_result_release_levels$fk_test_result_release_levels_release_levels1] FOREIGN KEY([release_level_id])
REFERENCES [dbo].[laboratory_release_levels] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_result_release_levels] CHECK CONSTRAINT [laboratory_test_result_release_levels$fk_test_result_release_levels_release_levels1]
GO
ALTER TABLE [dbo].[laboratory_test_result_release_levels]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_result_release_levels$fk_test_result_release_levels_test_result_remarks1] FOREIGN KEY([test_result_id])
REFERENCES [dbo].[laboratory_test_results] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_result_release_levels] CHECK CONSTRAINT [laboratory_test_result_release_levels$fk_test_result_release_levels_test_result_remarks1]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimen_histories]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_result_specimen_histories$fk_test_result_specimen_histories_test_result_specimens1] FOREIGN KEY([test_result_specimen_id])
REFERENCES [dbo].[laboratory_test_result_specimens] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_result_specimen_histories] CHECK CONSTRAINT [laboratory_test_result_specimen_histories$fk_test_result_specimen_histories_test_result_specimens1]
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_result_specimens$fk_test_result_specimens_test_results1] FOREIGN KEY([test_result_id])
REFERENCES [dbo].[laboratory_test_results] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_result_specimens] CHECK CONSTRAINT [laboratory_test_result_specimens$fk_test_result_specimens_test_results1]
GO
ALTER TABLE [dbo].[laboratory_test_results]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_results$fk_test_orders1] FOREIGN KEY([test_order_id])
REFERENCES [dbo].[laboratory_test_orders] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_results] CHECK CONSTRAINT [laboratory_test_results$fk_test_orders1]
GO
ALTER TABLE [dbo].[laboratory_test_sets]  WITH NOCHECK ADD  CONSTRAINT [laboratory_test_sets$FK_test_sets_laboratories] FOREIGN KEY([laboratory_id])
REFERENCES [dbo].[laboratories] ([id])
GO
ALTER TABLE [dbo].[laboratory_test_sets] CHECK CONSTRAINT [laboratory_test_sets$FK_test_sets_laboratories]
GO
ALTER TABLE [dbo].[laboratory_tests]  WITH NOCHECK ADD  CONSTRAINT [laboratory_tests$FK_tests_laboratories] FOREIGN KEY([laboratory_id])
REFERENCES [dbo].[laboratories] ([id])
GO
ALTER TABLE [dbo].[laboratory_tests] CHECK CONSTRAINT [laboratory_tests$FK_tests_laboratories]
GO
ALTER TABLE [dbo].[patients]  WITH NOCHECK ADD  CONSTRAINT [patients$FK_patients_people] FOREIGN KEY([person_id])
REFERENCES [dbo].[people] ([id])
GO
ALTER TABLE [dbo].[patients] CHECK CONSTRAINT [patients$FK_patients_people]
GO
ALTER TABLE [dbo].[people]  WITH NOCHECK ADD  CONSTRAINT [people$FK_people_suffixes] FOREIGN KEY([suffix_id])
REFERENCES [dbo].[suffixes] ([id])
GO
ALTER TABLE [dbo].[people] CHECK CONSTRAINT [people$FK_people_suffixes]
GO
ALTER TABLE [dbo].[people]  WITH NOCHECK ADD  CONSTRAINT [people$FK_people_title_codes] FOREIGN KEY([title_id])
REFERENCES [dbo].[title_codes] ([id])
GO
ALTER TABLE [dbo].[people] CHECK CONSTRAINT [people$FK_people_title_codes]
GO
ALTER TABLE [dbo].[person_addresses]  WITH NOCHECK ADD  CONSTRAINT [person_addresses$FK_person_addresses_addresses] FOREIGN KEY([address_id])
REFERENCES [dbo].[addresses] ([id])
GO
ALTER TABLE [dbo].[person_addresses] CHECK CONSTRAINT [person_addresses$FK_person_addresses_addresses]
GO
ALTER TABLE [dbo].[person_addresses]  WITH NOCHECK ADD  CONSTRAINT [person_addresses$FK_person_addresses_people] FOREIGN KEY([person_id])
REFERENCES [dbo].[people] ([id])
GO
ALTER TABLE [dbo].[person_addresses] CHECK CONSTRAINT [person_addresses$FK_person_addresses_people]
GO
ALTER TABLE [dbo].[person_aliases]  WITH NOCHECK ADD  CONSTRAINT [person_aliases$FK_person_aliases_people] FOREIGN KEY([person_id])
REFERENCES [dbo].[people] ([id])
GO
ALTER TABLE [dbo].[person_aliases] CHECK CONSTRAINT [person_aliases$FK_person_aliases_people]
GO
ALTER TABLE [dbo].[person_aliases]  WITH NOCHECK ADD  CONSTRAINT [person_aliases$FK_person_aliases_people1] FOREIGN KEY([alias_person_id])
REFERENCES [dbo].[people] ([id])
GO
ALTER TABLE [dbo].[person_aliases] CHECK CONSTRAINT [person_aliases$FK_person_aliases_people1]
GO
ALTER TABLE [dbo].[person_contact_informations]  WITH NOCHECK ADD  CONSTRAINT [person_contact_informations$FK_person_contact_informations_contact_informations] FOREIGN KEY([contact_id])
REFERENCES [dbo].[contact_informations] ([id])
GO
ALTER TABLE [dbo].[person_contact_informations] CHECK CONSTRAINT [person_contact_informations$FK_person_contact_informations_contact_informations]
GO
ALTER TABLE [dbo].[person_contact_informations]  WITH NOCHECK ADD  CONSTRAINT [person_contact_informations$FK_person_contact_informations_people] FOREIGN KEY([person_id])
REFERENCES [dbo].[people] ([id])
GO
ALTER TABLE [dbo].[person_contact_informations] CHECK CONSTRAINT [person_contact_informations$FK_person_contact_informations_people]
GO
ALTER TABLE [dbo].[person_educational_backgrounds]  WITH NOCHECK ADD  CONSTRAINT [person_educational_backgrounds$FK_person_educational_backgrounds_education_degrees] FOREIGN KEY([education_degree_id])
REFERENCES [dbo].[education_degrees] ([id])
GO
ALTER TABLE [dbo].[person_educational_backgrounds] CHECK CONSTRAINT [person_educational_backgrounds$FK_person_educational_backgrounds_education_degrees]
GO
ALTER TABLE [dbo].[person_educational_backgrounds]  WITH NOCHECK ADD  CONSTRAINT [person_educational_backgrounds$FK_person_educational_backgrounds_education_levels] FOREIGN KEY([education_level_id])
REFERENCES [dbo].[education_levels] ([id])
GO
ALTER TABLE [dbo].[person_educational_backgrounds] CHECK CONSTRAINT [person_educational_backgrounds$FK_person_educational_backgrounds_education_levels]
GO
ALTER TABLE [dbo].[person_educational_backgrounds]  WITH NOCHECK ADD  CONSTRAINT [person_educational_backgrounds$FK_person_educational_backgrounds_education_majors] FOREIGN KEY([education_major_id])
REFERENCES [dbo].[education_courses] ([id])
GO
ALTER TABLE [dbo].[person_educational_backgrounds] CHECK CONSTRAINT [person_educational_backgrounds$FK_person_educational_backgrounds_education_majors]
GO
ALTER TABLE [dbo].[person_educational_backgrounds]  WITH NOCHECK ADD  CONSTRAINT [person_educational_backgrounds$FK_person_educational_backgrounds_education_majors1] FOREIGN KEY([education_minor_id])
REFERENCES [dbo].[education_courses] ([id])
GO
ALTER TABLE [dbo].[person_educational_backgrounds] CHECK CONSTRAINT [person_educational_backgrounds$FK_person_educational_backgrounds_education_majors1]
GO
ALTER TABLE [dbo].[person_educational_backgrounds]  WITH NOCHECK ADD  CONSTRAINT [person_educational_backgrounds$FK_person_educational_backgrounds_people] FOREIGN KEY([person_id])
REFERENCES [dbo].[people] ([id])
GO
ALTER TABLE [dbo].[person_educational_backgrounds] CHECK CONSTRAINT [person_educational_backgrounds$FK_person_educational_backgrounds_people]
GO
ALTER TABLE [dbo].[person_educational_backgrounds]  WITH NOCHECK ADD  CONSTRAINT [person_educational_backgrounds$FK_person_educational_backgrounds_schools] FOREIGN KEY([school_id])
REFERENCES [dbo].[schools] ([id])
GO
ALTER TABLE [dbo].[person_educational_backgrounds] CHECK CONSTRAINT [person_educational_backgrounds$FK_person_educational_backgrounds_schools]
GO
ALTER TABLE [dbo].[person_expertise]  WITH NOCHECK ADD  CONSTRAINT [person_expertise$FK_person_expertise_people] FOREIGN KEY([person_id])
REFERENCES [dbo].[people] ([id])
GO
ALTER TABLE [dbo].[person_expertise] CHECK CONSTRAINT [person_expertise$FK_person_expertise_people]
GO
ALTER TABLE [dbo].[person_identifications]  WITH NOCHECK ADD  CONSTRAINT [person_identifications$FK_person_identifications_identification_types] FOREIGN KEY([identification_id])
REFERENCES [dbo].[identification_types] ([id])
GO
ALTER TABLE [dbo].[person_identifications] CHECK CONSTRAINT [person_identifications$FK_person_identifications_identification_types]
GO
ALTER TABLE [dbo].[person_identifications]  WITH NOCHECK ADD  CONSTRAINT [person_identifications$FK_person_identifications_people] FOREIGN KEY([person_id])
REFERENCES [dbo].[people] ([id])
GO
ALTER TABLE [dbo].[person_identifications] CHECK CONSTRAINT [person_identifications$FK_person_identifications_people]
GO
ALTER TABLE [dbo].[person_identities]  WITH NOCHECK ADD  CONSTRAINT [person_identities$FK_person_identities_laboratories2] FOREIGN KEY([laboratory_id])
REFERENCES [dbo].[laboratories] ([id])
GO
ALTER TABLE [dbo].[person_identities] CHECK CONSTRAINT [person_identities$FK_person_identities_laboratories2]
GO
ALTER TABLE [dbo].[person_identities]  WITH NOCHECK ADD  CONSTRAINT [person_identities$FK_person_identities_people] FOREIGN KEY([person_id])
REFERENCES [dbo].[people] ([id])
GO
ALTER TABLE [dbo].[person_identities] CHECK CONSTRAINT [person_identities$FK_person_identities_people]
GO
ALTER TABLE [dbo].[person_insurance]  WITH NOCHECK ADD  CONSTRAINT [person_insurance$FK_person_insurance_insurance_provider_products] FOREIGN KEY([insurance_provider_product_id])
REFERENCES [dbo].[insurance_provider_products] ([id])
GO
ALTER TABLE [dbo].[person_insurance] CHECK CONSTRAINT [person_insurance$FK_person_insurance_insurance_provider_products]
GO
ALTER TABLE [dbo].[person_insurance]  WITH NOCHECK ADD  CONSTRAINT [person_insurance$FK_person_insurance_people] FOREIGN KEY([person_id])
REFERENCES [dbo].[people] ([id])
GO
ALTER TABLE [dbo].[person_insurance] CHECK CONSTRAINT [person_insurance$FK_person_insurance_people]
GO
ALTER TABLE [dbo].[person_organizations_affiliations]  WITH NOCHECK ADD  CONSTRAINT [person_organizations_affiliations$FK_person_organizations_affiliations_organizations_affliations] FOREIGN KEY([organization_id])
REFERENCES [dbo].[organizations_affliations] ([id])
GO
ALTER TABLE [dbo].[person_organizations_affiliations] CHECK CONSTRAINT [person_organizations_affiliations$FK_person_organizations_affiliations_organizations_affliations]
GO
ALTER TABLE [dbo].[person_organizations_affiliations]  WITH NOCHECK ADD  CONSTRAINT [person_organizations_affiliations$FK_person_organizations_affiliations_people] FOREIGN KEY([person_id])
REFERENCES [dbo].[people] ([id])
GO
ALTER TABLE [dbo].[person_organizations_affiliations] CHECK CONSTRAINT [person_organizations_affiliations$FK_person_organizations_affiliations_people]
GO
ALTER TABLE [dbo].[person_relatives]  WITH NOCHECK ADD  CONSTRAINT [person_relatives$FK_person_relatives_people] FOREIGN KEY([person_id])
REFERENCES [dbo].[people] ([id])
GO
ALTER TABLE [dbo].[person_relatives] CHECK CONSTRAINT [person_relatives$FK_person_relatives_people]
GO
ALTER TABLE [dbo].[person_work_experiences]  WITH NOCHECK ADD  CONSTRAINT [person_work_experiences$FK_person_work_experiences_company_branches] FOREIGN KEY([company_branch_id])
REFERENCES [dbo].[company_branches] ([id])
GO
ALTER TABLE [dbo].[person_work_experiences] CHECK CONSTRAINT [person_work_experiences$FK_person_work_experiences_company_branches]
GO
ALTER TABLE [dbo].[person_work_experiences]  WITH NOCHECK ADD  CONSTRAINT [person_work_experiences$FK_person_work_experiences_people] FOREIGN KEY([person_id])
REFERENCES [dbo].[people] ([id])
GO
ALTER TABLE [dbo].[person_work_experiences] CHECK CONSTRAINT [person_work_experiences$FK_person_work_experiences_people]
GO
ALTER TABLE [dbo].[physicians]  WITH NOCHECK ADD  CONSTRAINT [physicians$FK_physicians_labs2] FOREIGN KEY([laboratory_id])
REFERENCES [dbo].[laboratories] ([id])
GO
ALTER TABLE [dbo].[physicians] CHECK CONSTRAINT [physicians$FK_physicians_labs2]
GO
ALTER TABLE [dbo].[provinces_states_codes]  WITH NOCHECK ADD  CONSTRAINT [provinces_states_codes$FK_provinces_states_codes_provincial_regions] FOREIGN KEY([provincial_region_id])
REFERENCES [dbo].[provincial_regions] ([id])
GO
ALTER TABLE [dbo].[provinces_states_codes] CHECK CONSTRAINT [provinces_states_codes$FK_provinces_states_codes_provincial_regions]
GO
ALTER TABLE [dbo].[schools]  WITH NOCHECK ADD  CONSTRAINT [schools$FK_schools_company_branches] FOREIGN KEY([company_branch_id])
REFERENCES [dbo].[company_branches] ([id])
GO
ALTER TABLE [dbo].[schools] CHECK CONSTRAINT [schools$FK_schools_company_branches]
GO
ALTER TABLE [dbo].[town_city_codes]  WITH NOCHECK ADD  CONSTRAINT [town_city_codes$FK_town_city_codes_provinces_states_codes] FOREIGN KEY([provinces_states_id])
REFERENCES [dbo].[provinces_states_codes] ([id])
GO
ALTER TABLE [dbo].[town_city_codes] CHECK CONSTRAINT [town_city_codes$FK_town_city_codes_provinces_states_codes]
GO
ALTER TABLE [dbo].[village_codes]  WITH NOCHECK ADD  CONSTRAINT [village_codes$FK_village_codes_town_city_codes] FOREIGN KEY([town_city_id])
REFERENCES [dbo].[town_city_codes] ([id])
GO
ALTER TABLE [dbo].[village_codes] CHECK CONSTRAINT [village_codes$FK_village_codes_town_city_codes]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.accreditations' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'accreditations'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.action_codes' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'action_codes'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.addresses' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'addresses'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.advertisements' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'advertisements'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.categories' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'categories'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.companies' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'companies'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.company_branch_accreditations' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'company_branch_accreditations'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.company_branch_addresses' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'company_branch_addresses'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.company_branch_contact_informations' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'company_branch_contact_informations'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.company_branch_images' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'company_branch_images'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.company_branch_info' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'company_branch_info'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.company_branch_member_duties' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'company_branch_member_duties'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.company_branch_members' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'company_branch_members'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.company_branch_operating_hours' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'company_branch_operating_hours'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.company_branch_services' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'company_branch_services'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.company_branches' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'company_branches'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.contact_informations' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'contact_informations'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.corporate_account_users' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'corporate_account_users'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.corporate_accounts' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'corporate_accounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.country_codes' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'country_codes'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.discounts' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'discounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.download_roles' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'download_roles'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.downloadable_files' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'downloadable_files'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.education_course_professions' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'education_course_professions'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.education_courses' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'education_courses'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.education_degrees' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'education_degrees'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.education_levels' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'education_levels'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.email_templates' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'email_templates'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.identification_types' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'identification_types'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.images' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'images'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.industries' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'industries'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.insurance_provider_products' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'insurance_provider_products'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.insurance_providers' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'insurance_providers'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratories' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratories'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_accepted_insurance' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_accepted_insurance'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_corporate_partner_package_prices' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_corporate_partner_package_prices'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_corporate_partner_test_group_prices' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_corporate_partner_test_group_prices'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_corporate_partners' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_corporate_partners'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_package_details' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_package_details'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_package_test_groups' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_package_test_groups'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_packages' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_packages'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_patient_batch_orders' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_patient_batch_orders'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_patient_batch_package_order_discounts' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_patient_batch_package_order_discounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_patient_batch_package_orders' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_patient_batch_package_orders'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_patient_order_details' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_patient_order_details'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_patient_order_physicians' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_patient_order_physicians'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_patient_orders' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_patient_orders'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_patient_package_orders' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_patient_package_orders'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_patient_transactions' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_patient_transactions'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_release_levels' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_release_levels'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_standard_test_groups' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_standard_test_groups'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_standard_tests' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_standard_tests'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_group_details' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_group_details'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_group_prices' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_group_prices'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_groups' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_groups'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_order_audit_logs' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_order_audit_logs'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_order_details' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_order_details'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_order_medical_reports' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_order_medical_reports'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_order_package_medical_reports' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_order_package_medical_reports'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_order_results' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_order_results'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_orders' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_orders'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_result_histories' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_result_histories'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_result_release_levels' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_result_release_levels'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_result_specimen_histories' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_result_specimen_histories'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_result_specimens' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_result_specimens'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_results' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_results'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_test_sets' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_test_sets'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.laboratory_tests' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'laboratory_tests'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.medical_report_templates' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'medical_report_templates'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.messages' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'messages'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.organizations_affliations' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'organizations_affliations'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.patients' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'patients'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.people' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'people'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.person_addresses' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'person_addresses'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.person_aliases' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'person_aliases'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.person_contact_informations' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'person_contact_informations'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.person_educational_backgrounds' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'person_educational_backgrounds'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.person_expertise' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'person_expertise'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.person_identifications' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'person_identifications'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.person_identities' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'person_identities'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.person_images' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'person_images'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.person_insurance' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'person_insurance'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.person_marks' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'person_marks'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.person_organizations_affiliations' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'person_organizations_affiliations'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.person_relatives' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'person_relatives'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.person_work_experiences' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'person_work_experiences'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.physician_profile' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'physician_profile'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.physicians' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'physicians'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.post_contents' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'post_contents'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.post_tags' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'post_tags'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.posts' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'posts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.privileges' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'privileges'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.professions' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'professions'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.provinces_states_codes' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'provinces_states_codes'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.provincial_regions' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'provincial_regions'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.replies' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'replies'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.schools' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'schools'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.services' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'services'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.street_codes' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'street_codes'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.suffixes' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'suffixes'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.sysdiagrams' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'sysdiagrams'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.tags' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'tags'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.title_codes' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'title_codes'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.tokens' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'tokens'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.town_city_codes' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'town_city_codes'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.users' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'users'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'resultonlinelive.village_codes' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'village_codes'
GO
