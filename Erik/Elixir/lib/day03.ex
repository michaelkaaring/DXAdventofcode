defmodule Aoc16.Day03 do

  def run do
    input = File.read!("inputs/03_input.txt")
    |> String.trim
    |> String.split("\n")
    |> Enum.map(fn (line) ->
      %{"x" => x, "y" => y, "z" => z} = Regex.named_captures(~r/(?<x>\d+)\s+(?<y>\d+)\s+(?<z>\d+)/, line)
      {x, _} = Integer.parse x
      {y, _} = Integer.parse y
      {z, _} = Integer.parse z
      {x, y, z}
    end)

    {process_list(input), process_list_vertically(input)}
  end

  defp process_list(list, valid \\ 0)

  defp process_list([h | t], valid) do
    valid = if is_valid?(h), do: valid + 1, else: valid
    process_list t, valid
  end

  defp process_list([], valid) do
    valid
  end

  defp process_list_vertically(list, acc \\ [], valid \\ 0)

  defp process_list_vertically([h | t], acc, valid) do
    acc = acc ++ [h]

    {acc, valid} = case length(acc) do
      3 ->
        {a, d, x} = Enum.at(acc, 0)
        {b, e, y} = Enum.at(acc, 1)
        {c, f, z} = Enum.at(acc, 2)

        valid = if is_valid?({a, b, c}), do: valid + 1, else: valid
        valid = if is_valid?({d, e, f}), do: valid + 1, else: valid
        valid = if is_valid?({x, y, z}), do: valid + 1, else: valid
        {[], valid}
      _ ->
        {acc, valid}
    end

    process_list_vertically(t, acc, valid)
  end

  defp process_list_vertically([], _acc, valid) do
    valid
  end

  def is_valid?({x, y, z}) do
    if ((x + y) > z) and ((x + z) > y) and ((z + y) > x), do: true, else: false
  end
end
