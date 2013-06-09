<?php

namespace DiskCache;

class DiskCache
{
	public $output_dir = 'cache';

	public function initialize()
	{
		if (!is_dir($this->output_dir))
		{
			mkdir ($this->output_dir, 0777, true);
		}
	}

	public function set($key, $value)
	{
		return file_put_contents($this->output_dir . '/' . $key, $value);
	}

	public function get($key)
	{
		if (file_exists($this->output_dir . '/' . $key))
		{
			return file_get_contents($this->output_dir . '/' . $key);
		}

		return false;
	}

	public function delete($key)
	{
		if (file_exists($this->output_dir . '/' . $key))
		{
			return unlink ($this->output_dir . '/' . $key);
		}

		return false;
	}

	public function delete_group($group)
	{
		foreach (glob($this->output_dir . '/*') as $file)
		{
			if (strpos(basename($file), '.') !== false)
			{
				list($group_name, $key) = explode('.', basename($file));

				if ($group_name === $group)
				{
					unlink ($file);
				}
			}
		}

		return;
	}

	public function flush()
	{
		foreach (glob($this->output_dir . '/*') as $file)
		{
			unlink ($file);
		}

		return;
	}
}