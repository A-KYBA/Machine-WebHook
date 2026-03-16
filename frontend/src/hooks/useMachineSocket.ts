import { useState, useEffect } from 'react';
import type { Machine } from '../types/machine';

export function useMachineSocket(url: string, user: string): Machine[] {
  const [machines, setMachines] = useState<Machine[]>([]);

  useEffect(() => {
    setMachines([]);
    const ws = new WebSocket(`${url}?user=${encodeURIComponent(user)}`);

    ws.onmessage = (e) => {
      const data: Machine = JSON.parse(e.data);
      setMachines((prev) => {
        const exists = prev.find((m) => m.name === data.name);
        if (exists) return prev.map((m) => (m.name === data.name ? { ...m, state: data.state } : m));
        return [...prev, data].sort((a, b) => a.name.localeCompare(b.name));
      });
    };

    return () => ws.close();
  }, [url, user]);

  return machines;
}
